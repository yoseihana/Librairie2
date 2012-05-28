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
        $data['view_title'] = 'Liste des livres';
        $data['livres'] = $this->book->getAll();

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
                Book::IMAGE         => null //TODO
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
            $auteurs = $this->author->getAll();
            $zone = $this->zone->findZoneByCode($livre[Book::ZONE]);
            $zones = $this->zone->getAll();

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
                Book::IMAGE         => null //TODO
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
            $data['view_title'] = 'Ajout d\'un livre';
            $data['auteurs'] = $this->author->getAll(); // La liste des auteurs
            $data['zones'] = $this->zone->getAll(); // La liste des zones

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
                'view_title' => 'Supression du livre: ' . $livre['titre'],
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
            'livres'     => $this->book->getAll(),
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
            die('L\'isbn "' . $isbn . '" n\'existe pas dans la base de donnée');
        }
        return true;
    }
}
/*
function verifierImage()
{
    global $validExtentions, $upload_dir;

    $fichier = $_FILES['fichier'];
    $extention = explode('.', $fichier['name']);
    $extentionFichier = $extention[1];

    $name = 'f' . rand(0, 100) . time() . '.' . $extentionFichier;
    $error = '';

    if (is_uploaded_file($fichier['tmp_name']))
    {

        $tmp_name = $fichier['tmp_name'];

        if (in_array($extentionFichier, $validExtentions))
        {
            move_uploaded_file($tmp_name, $upload_dir . '/' . $name); // Finir test
        }
        else
        {
            die('Error extentions'); // voir une autre solution
        }
    }
    else
    {
        switch ($_FILES['fichier']['error'])
        {
            case 1:
                $error = 'Le fichier est trop grand';
                break;
            case 2:
                $error = 'Le fichier est plus grand que la taille spécifiée dans le formulaire';
                break;
            case 3:
                $error = 'La totalitée du fichiée n\'a pas été reçu';
                break;
            case 4:
                $error = 'Aucun fichier n\'a été téléchargé';
                break;
            case 7:
                $error = 'Le fichier n\'a pas été écrit sur le serveur';
                break;
        }
    }

    return array('error' => $error, 'name' => $name);
}
*/