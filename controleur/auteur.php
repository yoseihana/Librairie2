<?php

include 'modeles/' . $c . '.php'; //pr se connecter à la BdD
// Produire les données à affichée et les données à utiliser. REgarde ce qu'on demande 

function lister() 
{// création de la $data et $html
    global $a; // pr déclarer les variables qui sont en dehors de la fonction, elles sont globale
    global $c;

    $data['view_title'] = 'Liste des auteurs';
    $data['auteurs']     = getList(); // Utilisation d'une fct dans le modèle. Utilisation de $c dedans?
    $html              = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier() 
{
    global $a, $c, $validActions, $validEntities;

    if (isset($_REQUEST['id_auteur'])) 
    { // vérifie si il y a bien qqch ds URL, tjs en GET
        $id_auteur = $_REQUEST['id_auteur'];
        if (!_idAuteurExiste($id_auteur)) 
        {
            die('l\'id auteur fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else 
    {
        die('vous devez fournir un id auteur pour voir le livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $champsAuteur['nom'] = $_POST['nom'];
        $champsAuteur['prenom'] = $_POST['prenom'];
        $champsAuteur['date_naissance'] = $_POST['date_naissance'];
        $champsAuteur['id_auteur'] = $id_auteur;
        
        update($champsAuteur);
        
       header('Location:'.$_SERVER['PHP_SELF'].'?a='.$validActions['lister'].'&c='.$validEntities['auteur']/*.'&id_auteur='.$id_auteur*/); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        
        $data['auteur'] = getOne($id_auteur);
        $data['view_title'] = 'Modification de l\'auteur: ' . $data['auteur']['nom'];
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
        
       header('Location:'.$_SERVER['PHP_SELF'].'?a=lister&c=auteur'); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        
       
        $data['view_title'] = 'Ajout de\'un auteur: ';
        $html = $a . $c .'.php';
        
        return array('data' => $data, 'html' => $html); // returne
    }
}

function supprimer() 
{
    global $a, $c, $validActions, $validEntities;

    if (isset($_REQUEST['id_auteur'])) 
    {
        $id_auteur = $_REQUEST['id_auteur'];
        if (!_idAuteurExiste($id_auteur)) 
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

      delete($id_auteur);
        
       header('Location:'.$_SERVER['PHP_SELF'].'?a='.$validActions['lister'].'&c='.$validEntities['auteur'].'&id_auteur='.$id_auteur ); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        
        $data['auteur'] = getOne($id_auteur);
        $data['view_title'] = 'Supression de l\'auteur: ' . $data['auteur']['nom'];
        $html = $a . $c . '.php';
        
        return array('data' => $data, 'html' => $html); // returne
    }

    
}

function voir() { // récupérer 1x les informations d'1 seul livre
    global $a, $c;

    if (isset($_GET['id_auteur'])) { // vérifie si il y a bien qqch ds URL, tjs en GET
        
        $id_auteur = $_GET['id_auteur'];
        
        if (!_idAuteurExiste($id_auteur)) {
            die('l\'id auteur fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else {
        die('vous devez fournir un id auteur pour voir le livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    $data['auteurs']     = getList();
    $data['auteur']      = getOne($id_auteur);
    $data['view_title'] = 'Fiche de l\'auteur: ' . $data['auteur']['nom'];
    $html               = $a . $c . '.php';

    return array('data' => $data, 'html' => $html);
}

function _idAuteurExiste($id_auteur) 
{ // uniquement ds se fichier, commence par un _ car utiliser uniquement ici
    if (!getidAuteurCount($id_auteur)) {
        return false;
    }
    else {
        return true;
    }
}