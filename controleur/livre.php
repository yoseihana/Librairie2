<?php

include 'modeles/livre.php';
include 'modeles/auteur.php';
include 'modeles/zone.php';

function lister()
{
    global $a, $c;

    $data['view_title'] = 'Liste des livres';
    $data['livres'] = getAllBooks();

    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier()
{
    global $a, $c, $validActions, $validEntities;

    // Récupère l'isbn depuis $_REQUEST avec gestion d'erreurs
    $isbn = _getIsbnFromRequest();

    // Test l'existance de l'isbn dans la DB
    _testIsbn($isbn);

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $champs['livre']['isbn'] = $isbn;
        $champs['livre']['titre'] = $_POST['titre'];
        $champs['livre']['nombre_page'] = $_POST['nombre_page'];
        $champs['livre']['date_parution'] = $_POST['date_parution'];
        $champs['livre']['genre'] = $_POST['genre'];
        $champs['livre']['code_zone'] = $_POST['code_zone'];

        $champs['auteur']['id_auteur'] = $_POST['id_auteur'];

        updateBook($champs);

        header('Location:' . voirLivreUrl($isbn)); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $livre = findBookByIsbn($isbn);

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

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $champs['livre']['isbn'] = $_POST['isbn']; // ou _getIsbnFromRequest()
        $champs['livre']['titre'] = $_POST['titre'];
        $champs['livre']['nombre_page'] = $_POST['nombre_page'];
        $champs['livre']['date_parution'] = $_POST['date_parution'];
        $champs['livre']['genre'] = $_POST['genre'];
        $champs['livre']['code_zone'] = $_POST['code_zone'];

        $champs['auteur']['id_auteur'] = $_POST['id_auteur'];

        addBook($champs);

        // Redirection
        header('Location:' . $_SERVER['PHP_SELF']); // donne la page index.php qui est par défaut
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
    global $a, $c, $validActions, $validEntities;

    $isbn = _getIsbnFromRequest();
    _testIsbn($isbn);

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        deleteBook($isbn);

        // Redirection
        header('Location:' . $_SERVER['PHP_SELF']); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $livre = findBookByIsbn($isbn);

        $data['view_title'] = 'Supression du livre: ' . $livre['titre'];
        $data['livre'] = $livre;

        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html); // returne
    }

}

function voir()
{ // récupérer 1x les informations d'1 seul livre
    global $a, $c;

    $isbn = _getIsbnFromRequest();
    _testIsbn($isbn);

    $livre = findBookByIsbn($isbn);

    $data['view_title'] = 'Fiche du livre: ' . $livre['titre'];
    $data['livres'] = getAllBooks();
    $data['livre'] = $livre; // Le livre à voir
    $data['livre']['auteur'] = findAuthorByBook($livre['isbn']);
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
    $validExtentions = array('jpg', 'png', 'jpeg', 'JPEG', 'gif');
    $fichier = $_FILES['fichier'];

    if (is_uploaded_file($fichier['name']))
    {
        $extention = explode('.', $fichier['name']);
        $extentionFichier = $extention[1];

        $upload_dir = './img';
        $name = $_POST['name'] . '.' . $extention[1];
        $tmp_name = $fichier['tmp_name'];

        if ($extention == in_array($extentionFichier, $validExtentions))
        {
            move_uploaded_file($tmp_name, $upload_dir . '/' . $name);
        }
        else
        {
            echo 'erreur!';
        }
    }
    else
    {
        switch ($_FILES['fichier']['error'])
        {
            case 1:
                echo 'Le fichier est trop grand';
                break;
            case 2:
                echo 'Le fichier est plus grand que la taille spécifiée dans le formulaire';
                break;
            case 3:
                echo 'La totalitée du fichiée n\'a pas été reçu';
                break;
            case 4:
                echo 'Aucun fichier n\'a été téléchargé';
                break;
            case 7:
                echo 'Le fichier n\'a pas été écrit sur le serveur';
                break;
        }
    }
}