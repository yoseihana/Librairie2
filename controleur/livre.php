<?php

include 'modeles/livre.php';

class C_livre
{

    function __construct()
    {
        $this->livre = new M_livre();
    }


    function lister()
    {
        global $a, $c;

        $data['view_title'] = 'Liste des livres';
        $data['livres'] = $this->livre->getAll();

        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html);
    }

}

function modifier()
{
    global $a, $c;

    // Récupère l'isbn depuis $_REQUEST avec gestion d'erreurs
    $isbn = _getIsbnFromRequest();

    // Test l'existance de l'isbn dans la DB
    _testIsbn($isbn);

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (empty($_FILES['fichier']['name']))
        {
            $name = $_POST['image'];

        } else
        {
            $verifImage = verifierImage();
            $name = $verifImage['name'];
            $error = $verifImage['error'];
        }

        if (empty($error))
        {
            $champs['livre']['isbn'] = $isbn;
            $champs['livre']['titre'] = $_POST['titre'];
            $champs['livre']['nombre_page'] = $_POST['nombre_page'];
            $champs['livre']['date_parution'] = $_POST['date_parution'];
            $champs['livre']['genre'] = $_POST['genre'];
            $champs['livre']['code_zone'] = $_POST['code_zone'];
            $champs['livre']['image'] = $name;

            $champs['auteur']['id_auteur'] = $_POST['id_auteur'];

            updateBook($champs, $champs['livre']['image']);
        }
        else
        {
            $livre = findBooksByIsbn($isbn);

            $data['view_title'] = 'Modification du livre: ' . $livre['titre'];
            $data['livre'] = $livre; // Le livre à modifier
            $data['livre']['auteur'] = findAuthorByBook($livre['isbn']);
            $data['livre']['zone'] = findZoneByCode($livre['code_zone']);
            $data['auteurs'] = getAllAuthors(); // La liste des auteurs
            $data['zones'] = getAllZones(); // La liste des zones
            $data['error'] = $error;

            $html = $a . $c . '.php';
            return array('data' => $data, 'html' => $html);
        }

        header('Location:' . voirLivreUrl($isbn)); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $livre = findBooksByIsbn($isbn);

        $data['view_title'] = 'Modification du livre: ' . $livre['titre'];
        $data['livre'] = $livre; // Le livre à modifier
        $data['livre']['auteur'] = findAuthorByBook($livre['isbn']);
        $data['livre']['zone'] = findZoneByCode($livre['code_zone']);
        $data['auteurs'] = getAllAuthors(); // La liste des auteurs
        $data['zones'] = getAllZones(); // La liste des zones

        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html);
    }
}

function ajouter()
{
    global $a, $c;
    $champs = array();
    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $verifImage = verifierImage();
        $name = $verifImage['name'];
        $error = $verifImage['error'];

        if (empty($error))
        {
            $champs['isbn'] = $_POST['isbn'];
            $champs['titre'] = $_POST['titre'];
            $champs['nombre_page'] = $_POST['nombre_page'];
            $champs['date_parution'] = $_POST['date_parution'];
            $champs['genre'] = $_POST['genre'];
            $champs['code_zone'] = $_POST['code_zone'];
            $champs['image'] = $name;

            $champs['id_auteur'] = $_POST['id_auteur'];

            addBook($champs);
        }

        // Redirection
        header('Location:' . voirLivreUrl($champs['isbn'])); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $data['view_title'] = 'Ajout d\'un livre';
        $data['auteurs'] = getAllAuthors(); // La liste des auteurs
        $data['zones'] = getAllZones(); // La liste des zones

        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html); // returne
    }
}

function supprimer()
{
    global $a, $c;

    $isbn = _getIsbnFromRequest();
    _testIsbn($isbn);

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        deleteBook($isbn);

        // Redirection
        header('Location:' . listerLivreUrl()); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $livre = findBooksByIsbn($isbn);

        $data['view_title'] = 'Supression du livre: ' . $livre['titre'];
        $data['livre'] = $livre;

        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html); // returne
    }

}

function voir()
{ // récupérer 1x les informations d'1 seul livre

    include ('auteur.php');
    include ('zone.php');

    global $a, $c;

    //Instantiation
    /*function __construct () {
        $this->auteur = new C_auteur();
        $this->zone = new C_zone();
    }*/

    $isbn = _getIsbnFromRequest();
    _testIsbn($isbn);

    $livre = findBooksByIsbn($isbn);

    $data['view_title'] = 'Fiche du livre: ' . $livre['titre'];
    $data['livres'] = getAllBooks();
    $data['livre'] = $livre; // Le livre à voir
    $data['livre']['auteur'] = findAuthorByBook($livre['isbn']);
    /*$this->auteur->findAuthorByBook($livre['isbn']);*/
    $data['livre']['zone'] = findZoneByCode($livre['code_zone']);

    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);

}

function _getIsbnFromRequest()
{
    global $a;

    if (!isset($_REQUEST['isbn']))
    {
        die('vous devez fournir un isbn pour ' . $a . ' un livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    return $_REQUEST['isbn'];
}

function _testIsbn($isbn)
{
    if (countBookByIsbn($isbn) < 1)
    {
        die('l\'isbn fournit n\'existe pas dans la base de donnée!');
        //header('Location:index.php?c=error&a=e_404');
    }
}

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