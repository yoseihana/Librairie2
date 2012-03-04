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

    valideImage();

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

function valideImage()
{
    $valideExtension = array('jpg', 'gif', 'jpeg', 'png');

    var_dump($_FILES);

    if (is_uploaded_file($_FILES['file']['name']) == 0)
    {
        if (!$_FILES['file']['error'])
        {
            // Lorsque tout va bien
            print $_FILES['file']['size']; // fichier se nomme file et on va chercher la clé error
            print $_FILES['file']['name'];
            $nom_fichier = $_FILES['file']['name'];
            $partie_nom = explode('.', $nom_fichier); //explosion du fichier lorsqu'il y a un . et mettre ds un tableau les différents éléments
            $extension = $partie_nom[count($partie_nom) - 1]; //Compte le nbre d'élément qu'il y a ds un tableau -1 pr avoir le dernier

            $uploadDir = '../img/'; // définition du répertoire
            $name = time() . rand(0, 100000) . '.' . $extension; //Création du nom de l'image

            if ($extension == in_array($extension, $valideExtension))
            {
                echo'<img src="' . $uploadDir . '/' . $name . '" alt="image" /> ';
                //Pr récupérer les différentes actions, ds un tableau selon les types tel valideAction ms en file et on liste les ≠ extentions qu'on accepte et on vérifie si l'extention est dedans et si on l'accepte
            }
            else
            {
                echo'l\'extension fichier n\'est pas correcte';
            }
            $tmp_name = $_FILES['file']['tmp_name']; //placement de l'image ds un fichier temporaire
            if (!move_uploaded_file($tmp_name, $uploadDir . '/' . $name)) // déplacement de l'image, c'est un booléen comme fct donc utilisation pr un if, on le fait et en mm tps on vérifie si c'est fait
            {
                //gestion erreur
                echo 'Erreur!';
            }
        }
        else
        {
            switch ($_FILES['file']['error'])
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
    else
    {
        echo'Erreur!';
    }
}