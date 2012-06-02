<?php
/**
 * Created by JetBrains PhpStorm.
 * User: annabelle
 * Date: 27/05/12
 * Time: 15:41
 * To change this template use File | Settings | File Templates.
 */

require_once 'AbstractController.php';
require_once './modeles/Book.php';
require_once './modeles/Author.php';
require_once './modeles/Written.php';
final class AuteurController extends AbstractController
{
    private $book;
    private $author;
    private $written;

    function __construct()
    {
        $this->book = new Book();
        $this->author = new Author();
        $this->written = new Written();
    }

    public static function getDefaultAction()
    {
        return 'lister';
    }

    public function lister()
    {
        $totaleAuteur = $this->author->countAuthor();
        $nombrePage = ceil($totaleAuteur['totale'] / 5);

        if (isset($_GET['page']))
        {
            $pageActuelle = intval($_GET['page']);

            if ($pageActuelle > $nombrePage)
            {
                $pageActuelle = $nombrePage;
            }
        }
        else
        {
            $pageActuelle = 1;
        }

        $premiereEntree = ($pageActuelle - 1) * 5;

        $data = array(
            'view_title' => 'Liste des auteurs',
            'auteurs'    => $this->author->getAll($premiereEntree),
            'nbPage'     => $nombrePage
        );

        $html = MainController::getLastViewFileName();

        return array('data'=> $data, 'html'=> $html);
    }

    public function voir()
    {
        $id_auteur = $this->getParameter('id_auteur');
        $this->isIdExiste($id_auteur);
        $auteur = $this->author->findById($id_auteur);

        $data = array(
            'view_title' => 'Fiche de l\'auteur ' . $auteur[Author::PRENOM] . ' ' . $auteur[Author::NOM],
            'auteur'     => $auteur,
            'livres'     => $this->book->findByAuthor($auteur[Author::ID_AUTEUR])
        );

        return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
    }

    public function modifier()
    {
        $id_auteur = $this->getParameter('id_auteur');
        $this->isIdExiste($id_auteur);

        if ($this->isPost())
        {
            $auteur = array(
                Author::ID_AUTEUR     => $id_auteur,
                Author::NOM           => $this->getParameter('nom'),
                Author::PRENOM        => $this->getParameter('prenom'),
                Author::DATE_NAISSANCE=> $this->getParameter('date_naissance'),
                Author::IMAGE         => NULL
            );

            $this->author->update($auteur);

            header('Location: ' . Url::voirAuteur($id_auteur));
        }
        elseif ($this->isGet())
        {
            $auteur = $this->author->findById($id_auteur);
            $livre = $this->book->findByAuthor($id_auteur);

            $data = array(
                'view_title'=> 'Modification de l\'auteur ' . $auteur[Author::PRENOM] . ' ' . $auteur[Author::NOM],
                'auteur'    => $auteur,
                'livre'     => $livre
            );

            return array('data' => $data, 'html'=> MainController::getLastViewFileName());
        }
    }

    public function ajouter()
    {
        if ($this->isPost())
        {
            $auteur = array(
                Author::NOM           => $this->getParameter('nom'),
                Author::PRENOM        => $this->getParameter('prenom'),
                Author::DATE_NAISSANCE=> $this->getParameter('date_naissance'),
                Author::IMAGE         => NULL
            );

            DB::getPdoInstance()->beginTransaction();
            $this->author->add($auteur);
            DB::getPdoInstance()->commit();

            header('Location: ' . Url::listerAuteur());
        }
        elseif ($this->isGet())
        {
            $data = array(
                'view_title' => 'Ajouter un auteur',
            );

            return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
        }
    }

    public function supprimer()
    {
        $id_auteur = $this->getParameter('id_auteur');
        $this->isIdExiste($id_auteur);

        if ($this->isPost())
        {
            DB::getPdoInstance()->beginTransaction();
            $this->written->deleteAllByIsbn($id_auteur);
            $this->author->delete($id_auteur);
            DB::getPdoInstance()->commit();

            header('Location: ' . Url::listerAuteur());
        }
        elseif ($this->isGet())
        {
            $auteur = $this->author->findById($id_auteur);
            $data = array(
                'view_title'=> 'Suppression de l\'auteur ' . $auteur[Author::PRENOM] . ' ' . $auteur[Author::NOM],
                'auteur'    => $auteur
            );

            return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
        }
    }

    private function isIdExiste($id_auteur)
    {
        if ($this->author->countAuthorById($id_auteur) < 1)
        {
            die ('l\'id "' . $id_auteur . '" de cet auteur n\' existe pas');
        }

        return true;
    }
}
