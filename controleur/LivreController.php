<?php

require_once 'AbstractController.php';

require_once './modeles/Book.php';
require_once './modeles/Written.php';
require_once './modeles/Author.php';
require_once './modeles/Zone.php';

final class LivreController extends AbstractController
{
    private $book;
    private $written;
    private $author;
    private $zone;

    function __construct()
    {
        global $imgUploader;
        global $imgResizer;
        $this->book = new Book();
        $this->written = new Written();
        $this->author = new Author();
        $this->zone = new Zone();
    }

    public static function getDefaultAction()
    {
        return 'lister';
    }

    public function lister()
    {
        $totaleLivres = $this->book->countBook();
        $nombrePages = ceil($totaleLivres['totale'] / 5);

        if (isset($_GET['page']))
        {
            $pageActuelle = intval($_GET['page']);
            if ($pageActuelle > $nombrePages)
            {
                $pageActuelle = $nombrePages;
            }
        }
        else
        {
            $pageActuelle = 1;
        }

        $premiereEntree = ($pageActuelle - 1) * 5;

        $data['view_title'] = 'Liste des livres';
        $data['livres'] = $this->book->getAll($premiereEntree);
        $data['nbPage'] = $nombrePages;

        $html = MainController::getLastViewFileName();
        return array(
            'data' => $data,
            'html' => $html
        );
    }

    function modifier()
    {
        // Récupère l'isbn depuis $_REQUEST avec gestion d'erreurs
        $isbn = $this->getParameter('isbn');

        // Test l'existance de l'isbn dans la DB
        $this->isIsbnExists($isbn);

        global $imgUploader;
        global $imgResizer;

        // POST - modifier le livre en DB
        // GET - données pour le formulaire
        if ($this->isPost())
        {
            $livre = array(
                Book::ISBN          => $isbn,
                Book::TITRE         => $this->getParameter('titre'),
                Book::PAGES         => $this->getParameter('nombre_page'),
                Book::DATE_PARUTION => $this->getParameter('date_parution'),
                Book::GENRE         => $this->getParameter('genre'),
                Book::ZONE          => $this->getParameter('code_zone'),
                Book::IMAGE         => $this->uploadImg('fichier', $this->getParameter('image'))
            );

            $ecritDelete = array(
                Written::ISBN      => $isbn,
                Written::AUTHOR_ID => $_POST['id_auteur2']
            );

            $ecritAdd = array(
                Written::ISBN      => $isbn,
                Written::AUTHOR_ID => $this->getParameter('id_auteur')
            );

            DB::getPdoInstance()->beginTransaction();
            $this->book->update($livre);
            $this->written->delete($ecritDelete);
            $this->written->add($ecritAdd);
            DB::getPdoInstance()->commit();

            header('Location:' . Url::voirLivre($isbn)); // donne la page index.php qui est par défaut
        }
        elseif ($this->isGet())
        {
            $livre = $this->book->findByIsbn($isbn);
            $auteur = $this->author->findByBook($isbn);
            $auteurs = $this->author->getAllAuthor();
            $zone = $this->zone->findZoneByCode($livre[Book::ZONE]);
            $zones = $this->zone->getAllZone();

            $data = array(
                'view_title' => 'Modification du livre: ' . $livre[Book::TITRE],
                'livre'      => $livre,
                'auteur'     => $auteur,
                'auteurs'    => $auteurs,
                'zone'       => $zone,
                'zones'      => $zones
            );

            return array(
                'data' => $data,
                'html' => MainController::getLastViewFileName());
        }
    }

    function ajouter()
    {
        // POST - modifier le livre en DB
        // GET - données pour le formulaire
        if ($this->isPost())
        {
            $livre = array(
                Book::ISBN          => $this->getParameter('isbn'),
                Book::TITRE         => $this->getParameter('titre'),
                Book::PAGES         => $this->getParameter('nombre_page'),
                Book::DATE_PARUTION => $this->getParameter('date_parution'),
                Book::GENRE         => $this->getParameter('genre'),
                Book::ZONE          => $this->getParameter('code_zone'),
                Book::IMAGE         => $this->uploadImg('fichier', NULL)
            );

            $ecrit = array(
                Written::ISBN      => $this->getParameter('isbn'),
                Written::AUTHOR_ID => $this->getParameter('id_auteur')
            );

            DB::getPdoInstance()->beginTransaction();
            $this->book->add($livre);
            $this->written->add($ecrit);
            DB::getPdoInstance()->commit();

            // Redirection
            header('Location:' . Url::voirLivre($this->getParameter('isbn')));
        }
        elseif ($this->isGet())
        {
            $data = array(
                'view_title' => 'Ajouter un livre',
                'auteurs'    => $this->author->getAllAuthor(),
                'zones'      => $this->zone->getAllZone()
            );

            return array(
                'data' => $data,
                'html' => MainController::getLastViewFileName()
            );
        }
    }


    public function supprimer()
    {
        $isbn = $this->getParameter('isbn');
        $this->isIsbnExists($isbn);

        // POST - modifier le livre en DB
        // GET - données pour le formulaire
        if ($this->isPost())
        {
            DB::getPdoInstance()->beginTransaction();
            $this->written->deleteAllByIsbn($isbn);
            $this->book->delete($isbn);
            DB::getPdoInstance()->commit();

            // Redirection
            header('Location:' . Url::listerLivre()); // donne la page index.php qui est par défaut
        }
        elseif ($this->isGet())
        {
            $livre = $this->book->findByIsbn($isbn);

            $data = array(
                'view_title' => 'Supression du livre: ' . $livre[Book::TITRE],
                'livre'      => $livre

            );

            return array(
                'data' => $data,
                'html' => MainController::getLastViewFileName()
            );
        }
    }

    public function voir()
    {
        $isbn = $this->getParameter('isbn');
        $this->isIsbnExists($isbn);

        $livre = $this->book->findByIsbn($isbn);

        $data = array(
            'view_title' => 'Fiche du livre: ' . $livre['titre'],
            'livre'      => $livre,
            'livres'     => $this->book->getAllBook(),
            'auteur'     => $this->author->findByBook($isbn),
            'zone'       => $this->zone->findZoneByCode($livre[Book::ZONE])
        );

        return array(
            'data' => $data,
            'html' => MainController::getLastViewFileName()
        );

    }

    private function isIsbnExists($isbn)
    {
        if ($this->book->countByIsbn($isbn) < 1)
        {
            Erreur::erreurId();
        }
        return true;
    }

    public function uploadImg($file, $defautValue = NULL)
    {
        global $imgUploader, $imgResizer;

        if ($imgUploader->getErrorCode($file) == UPLOAD_ERR_NO_FILE)
        {
            return $defautValue;
        }

        if (!$imgUploader->isFileExists($file))
        {
            Erreur::erreurFichier();
        }

        if (!$imgUploader->isValidExtension($file))
        {
            Erreur::erreurExtention();
        }

        if (!$imgUploader->isValidFileSize($file))
        {
            Erreur::erreurTaille();
        }

        //$return = $imgUploader->save($file, 'f' . rand(0, 100) . time());

        $return = $imgResizer->resizeImage($_FILES[$file]['tmp_name'], 'f' . rand(0, 100) . time());
        if (!$return)
        {
            Erreur::erreurChargement();
        }

        return $return;
    }
}