<?php

include 'modeles/livre.php';
include 'modeles/auteur.php';
include 'modeles/zone.php';

function lister() {
    global $a, $c;

    $data['view_title'] = 'Liste des livres';
    $data['livres'] = getAllBooks();

    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier() {
    global $a, $c, $validActions, $validEntities;

    // Récupère l'isbn depuis $_REQUEST avec gestion d'erreurs
    $isbn = _getIsbnFromRequest();

    // Test l'existance de l'isbn dans la DB
    _testIsbn($isbn);

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        return array('data' => $data, 'html' => $html); // returne
    }
}

function ajouter() {
    global $a, $c;

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

function supprimer() {
    global $a, $c, $validActions, $validEntities;

    $isbn = _getIsbnFromRequest();
    _testIsbn($isbn);

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

function voir() { // récupérer 1x les informations d'1 seul livre
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

function _getIsbnFromRequest() {
    global $a;

    if (!isset($_REQUEST['isbn'])) {
        die('vous devez fournir un isbn pour ' . $a . ' un livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    return $_REQUEST['isbn'];
}

function _testIsbn($isbn) {
    if (countBookByIsbn($isbn) < 1) {
        die('l\'isbn fournit n\'existe pas dans la base de donnée!');
        //header('Location:index.php?c=error&a=e_404');
    }
}

function valideExtension() {
    $valideExtension = array('jpg', 'gif', 'jpeg', 'png');

    if ($_FILES['file']['error'] == 0) {
        $nom_fichier = $_FILES['file']['name'];
        $partie_nom = explode('.', $nom_fichier);
        $extension = $partie_nom[count($partie_nom - 1)];

        $uploadDirection = './imgb/';
        $nomImage = time() . rand(0, 10000) . '.' . $extension;

        if ($extension == in_array($extension, $valideExtension)) {
            //echo '<img src="'.$uploadDirection.$nomImage.'" title="Mon image" />';
            header('Location:index.php?c=livre&a=lister.php');
        }
        else
        {
            echo 'Le type de fichier n\'est pas accepté';
        }


        $nomTemporaire = $_FILES['file']['tmp_name'];
        move_uploaded_file($nomTemporaire, $uploadDirection . '/' . $nomImage);

        if (!move_uploaded_file($nomTemporaire, $uploadDirection . '/' . $nomImage)) {
            echo 'Il y a eu une erreur dans le chargement de l\'image!';
        }
    }
    else
    {
        switch ($_FILES['file']['error'])
        {
            case 1;
                echo 'Le fichier dépasse la taille maximale';
                break;
            case 2;
                echo 'Le fichier envoyé est suppérieur à la taille définie dans le HTML ';
                break;
            case 3;
                echo 'Le serveur n\'a pas reçu la totalitée';
                break;
            case 4;
                echo 'Aucun fichier n\'a été télécharger';
                break;
            case 6;
                echo 'Le repertoir temporaire est manquant';
                break;
            case 7;
                echo 'Echec de l\'écriture';
                break;
        }
    }
}