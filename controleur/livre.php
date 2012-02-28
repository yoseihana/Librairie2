<?php

include 'modeles/' . $c . '.php'; //pr se connecter à la BdD
// Produire les données à affichée et les données à utiliser. REgarde ce qu'on demande 

function lister()
{ // création de la $data et $html
    global $a; // pr déclarer les variables qui sont en dehors de la fonction, elles sont globale
    global $c;

    $data['view_title'] = 'Liste des livres';
    $data['livres'] = getList(); // Utilisation d'une fct dans le modèle. Utilisation de $c dedans?
    include 'modeles/auteur.php';
    $nbLivres = count($data['livres']);
    for ($i = 0; $i < $nbLivres; $i++) {
        $isbn = $data['livres'][$i]['isbn'];
        $data['livres'][$i]['auteurs'] = getAuthorsForBook($isbn);
    } //Permet d'avoir une nouvelle req pour afficher l'auteur en lui-même


    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier()
{
    global $a, $c, $validActions, $validEntities;

    if (isset($_REQUEST['isbn'])) { // vérifie si il y a bien qqch ds URL, tjs en GET
        $isbn = $_REQUEST['isbn'];
        if (!_isbnExiste($isbn)) {
            die('l\'isbn fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else
    {
        die('vous devez fournir un isbn pour voir le livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

    if (isset($_REQUEST['isbn'])) {
        $isbn = $_REQUEST['isbn'];
        if (!_isbnExiste($isbn)) {
            header('Location:index.php?c=error&a=e_404');
        }
    }
    else
    {
        header('Location:index.php?c=error&a=e_404');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

    if (isset($_GET['isbn'])) { // vérifie si il y a bien qqch ds URL, tjs en GET
        $isbn = $_GET['isbn'];
        if (!_isbnExiste($isbn)) {
            die('l\'isbn fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else {
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
    if (!getISBNCount($isbn)) { // compte le nbre d'occurance d'ISBN, il devrait y en avoir que 1 car clé primaire
        return false;
    }
    else {
        return true;
    }
}