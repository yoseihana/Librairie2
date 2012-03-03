<?php

include 'modeles/' . $c . '.php'; //pr se connecter à la BdD
// Produire les données à affichée et les données à utiliser. REgarde ce qu'on demande 

function lister()
{ // création de la $data et $html
    global $a, $c; // pr déclarer les variables qui sont en dehors de la fonction, elles sont globale

    $data['view_title'] = 'Liste des livres';
    $data['livres'] = getList(); // Utilisation d'une fct dans le modèle. Utilisation de $c dedans?

    $nbLivres = count($data['livres']);

    for ($i = 0; $i < $nbLivres; $i++)
    {
        $isbn = $data['livres'][$i]['isbn'];


    } //Permet d'avoir une nouvelle req pour afficher l'auteur en lui-même

    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier()
{
    global $a, $c, $validActions, $validEntities;

    if (isset($_REQUEST['isbn']))
    { // vérifie si il y a bien qqch ds URL, tjs en GET
        $isbn = $_REQUEST['isbn'];
        if (!_isbnExiste($isbn))
        {
            die('l\'isbn fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else
    {
        die('vous devez fournir un isbn pour voir le livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $champsLivre['titre'] = $_POST['titre'];
        $champsLivre['nombre_page'] = $_POST['nombre_page'];
        $champsLivre['date_parution'] = $_POST['date_parution'];
        $champsLivre['genre'] = $_POST['genre'];
        $champsLivre['isbn'] = $isbn;

        update($champsLivre);

        header('Location:' . $_SERVER['PHP_SELF'] . '?a=' . $validActions['voir'] . '&c=' . $validEntities['livre'] . '&isbn=' . $isbn); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $data['livre'] = getOne($isbn);
        $data['view_title'] = 'Modification du livre: ' . $data['livre']['titre'];
        $html = $a . $c . '.php';

        return array('data' => $data, 'html' => $html); // returne
    }

}

function ajouter()
{
    global $a, $c, $validActions, $validEntities;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        add();

        header('Location:' . $_SERVER['PHP_SELF']); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $data['view_title'] = 'Ajout de livre: ';
        $html = $a . $c . '.php';

        return array('data' => $data, 'html' => $html); // returne
    }
}

function supprimer()
{
    global $a, $c, $validActions, $validEntities;

    if (isset($_REQUEST['isbn']))
    {
        $isbn = $_REQUEST['isbn'];
        if (!_isbnExiste($isbn))
        {
            header('Location:index.php?c=error&a=e_404');
        }
    }
    else
    {
        header('Location:index.php?c=error&a=e_404');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        delete($isbn);

        header('Location:' . $_SERVER['PHP_SELF']); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $data['livre'] = getOne($isbn);
        $data['view_title'] = 'Supression du livre: ' . $data['livre']['titre'];
        $html = $a . $c . '.php';

        return array('data' => $data, 'html' => $html); // returne
    }

}

function voir()
{ // récupérer 1x les informations d'1 seul livre
    global $a, $c;

    if (isset($_GET['isbn']))
    { // vérifie si il y a bien qqch ds URL, tjs en GET
        $isbn = $_GET['isbn'];
        if (!_isbnExiste($isbn))
        {
            die('l\'isbn fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else
    {
        die('vous devez fournir un isbn pour voir le livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    $data['livres'] = getList();
    $data['livre'] = getOne($isbn);
    $data['view_title'] = 'Fiche du livre: ' . $data['livre']['titre'];

    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);

}

function _isbnExiste($isbn)
{ // uniquement ds se fichier, commence par un _ car utiliser uniquement ici
    if (!getISBNCount($isbn))
    { // compte le nbre d'occurance d'ISBN, il devrait y en avoir que 1 car clé primaire
        return false;
    }
    else
    {
        return true;
    }
}

function valideExtension ()
{
    $valideExtension = array('jpg', 'gif', 'jpeg', 'png');

    if($_FILES['file']['error'] == 0)
    {
        $nom_fichier = $_FILES['file']['name'];
        $partie_nom = explode('.', $nom_fichier) ;
        $extension = $partie_nom[count($partie_nom -1)];

        $uploadDirection = './imgb/';
        $nomImage = time().rand(0,10000).'.'.$extension;

        if($extension == in_array($extension, $valideExtension))
        {
            //echo '<img src="'.$uploadDirection.$nomImage.'" title="Mon image" />';
            header('Location:index.php?c=livre&a=lister.php');
        }
        else
        {
            echo 'Le type de fichier n\'est pas accepté';
        }


        $nomTemporaire = $_FILES['file']['tmp_name'];
        move_uploaded_file ($nomTemporaire, $uploadDirection.'/'.$nomImage);

        if(!move_uploaded_file ($nomTemporaire, $uploadDirection.'/'.$nomImage))
        {
            echo 'Il y a eu une erreur dans le chargement de l\'image!';
        }
    }
    else
    {
        switch($_FILES['file']['error'])
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