<?php

include 'modeles/auteur.php'; // pr se connecter à la BdD
include 'modeles/livre.php';
include 'modeles/zone.php';
// Produire les données à affichée et les données à utiliser. REgarde ce qu'on demande 

function lister()
{ // création de la $data et $html
    global $a, $c; // pr déclarer les variables qui sont en dehors de la fonction, elles sont globale

    $data['view_title'] = 'Liste des auteurs';
    $data['auteurs'] = getAllAuthors();
    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier()
{
    global $a, $c;

    $id_auteur = _getIdauteurFromRequest();
    _testIdAuteur($id_auteur);


    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (empty($_FILES['fichier']['name']))
        {
            $name = $_POST['image'];
        } else
        {
            $verifImage = verifierImage();
            $error = $verifImage['error'];
            $name = $verifImage['name'];
        }

        if (empty($error))
        {

            $champs['auteur']['nom'] = $_POST['nom'];
            $champs['auteur']['prenom'] = $_POST['prenom'];
            $champs['auteur']['date_naissance'] = $_POST['date_naissance'];
            $champs['auteur']['id_auteur'] = $id_auteur;
            $champs['auteur']['image'] = $name;

            updateAuthor($champs, $name);
        } else
        {
            $auteur = findAuthorById($id_auteur);

            $data['view_title'] = 'Modification de l\auteur: ' . $auteur['nom'];
            $data['auteur'] = $auteur; // Le livre à modifier
            $data['error'] = $error;
            $html = $a . $c . '.php';

            return array('data' => $data, 'html' => $html);
        }

        header('Location:' . voirAuteurUrl($id_auteur)); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {

        $auteur = findAuthorById($id_auteur);

        $data['view_title'] = 'Modification de l\auteur: ' . $auteur['nom'];
        $data['auteur'] = $auteur; // Le livre à modifier
        $html = $a . $c . '.php';

        return array('data' => $data, 'html' => $html);
    }
}

function ajouter()
{
    global $a, $c;
    $champs = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $verifImage = verifierImage();
        $name = $verifImage['name'];
        $error = $verifImage['error'];

        if (empty($erro))
        {

            $champs['nom'] = $_POST['nom'];
            $champs['prenom'] = $_POST['prenom'];
            $champs['date_naissance'] = $_POST['date_naissance'];
            $champs['image'] = $name;
            $champs['error'] = $error;

            //$insertedid = l'utiliser pr récuperer l'id insérer et ainsi redirigé vers la page
            addAuthor($champs);
        }

        header('Location:' . listerAuteurUrl()); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {


        $data['view_title'] = 'Ajout de\'un auteur: ';
        $html = $a . $c . '.php';

        return array('data' => $data, 'html' => $html); // returne
    }
}

function supprimer()
{
    global $a, $c;

    $id_auteur = _getIdauteurFromRequest();
    _testIdAuteur($id_auteur);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        deleteAuthor($id_auteur);

        header('Location:' . listerAuteurUrl()); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $auteur = findAuthorById($id_auteur);

        $data['view_title'] = 'Supression de l\'auteur: ' . $auteur['nom'];
        $data['auteur'] = $auteur;

        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html); // returne
    }
}

function voir()
{ // récupérer 1x les informations d'1 seul livre
    global $a, $c;

    $id_auteur = _getIdauteurFromRequest();
    _testIdAuteur($id_auteur);

    $auteur = findAuthorById($id_auteur);

    $data['auteurs'] = getAllAuthors();
    $data['auteur'] = $auteur; // auteur à voir
    $data['view_title'] = 'Fiche de l\'auteur: ' . $auteur['nom'];
    $data['auteur']['livre'] = findBooksByAuthor($auteur['id_auteur']);
    $html = $a . $c . '.php';

    return array('data' => $data, 'html' => $html);
}

function _testIdAuteur($id_auteur)
{
    if (countAuthorByIdautor($id_auteur) < 1)
    {
        die ('l\'id auteur n\'est pas dans la base de donnée');
        //header('Location:index.php?c=error&a=e_404');
    }
}

function _getIdauteurFromRequest()
{
    global $a;

    if (!isset($_REQUEST['id_auteur']))
    {
        die('vous devez fournir un id auteur pour ' . $a . ' un livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    return $_REQUEST['id_auteur'];
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