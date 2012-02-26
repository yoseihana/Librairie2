<?php

include 'modeles/' . $c . '.php'; 


function lister() 
{
    global $a, $c;

    $data['view_title'] = 'Liste des zones';
    $data['zones'] = getList(); 
    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier() 
{
    global $a, $c, $validActions, $validEntities;

    if (isset($_REQUEST['code_zone'])) 
    {
        $code_zone = $_REQUEST['code_zone'];
        if (!_codeZoneExiste($code_zone)) 
        {
            die('le code zone fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else 
    {
        die('vous devez fournir un code zone pour voir le livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $champsZone['piece'] = $_POST['piece'];
        $champsZone['meuble'] = $_POST['meuble'];
        $champsZone['code_zone'] = $code_zone;
        
        update($champsZone);
        
       header('Location:'.$_SERVER['PHP_SELF'].'?a='.$validActions['voir'].'&c='.$validEntities['zone'].'&code_zone='.$code_zone);
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        
        $data['zone'] = getOne($code_zone);
        $data['view_title'] = 'Modification de la zone: ' . $data['zone']['piece'];
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
        
       header('Location:'.$_SERVER['PHP_SELF'].'?a=lister&c=zone'); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        
       
        $data['view_title'] = 'Ajout de la zone: ';
        $html = $a . $c .'.php';
        
        return array('data' => $data, 'html' => $html); // returne
    }
}

function supprimer() 
{
   global $a, $c, $validActions, $validEntities;

    if (isset($_REQUEST['code_zone'])) 
    {
        $code_zone = $_REQUEST['code_zone'];
        if (!_codeZoneExiste($code_zone)) 
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
        
      delete($code_zone);
        
      header('Location:'.$_SERVER['PHP_SELF'].'?a='.$validActions['lister'].'&c='.$validEntities['zone'].'&code_zone='.$code_zone);
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        
        $data['zone'] = getOne($code_zone);
        $data['view_title'] = 'Supression da zone: ' . $data['zone']['piece'].' - '.$data['zone']['meuble'];
        $html = $a . $c . '.php';
        
        return array('data' => $data, 'html' => $html); // returne
    }

    
}

function voir() { // récupérer 1x les informations d'1 seul livre
    global $a, $c;

    if (isset($_GET['code_zone'])) { // vérifie si il y a bien qqch ds URL, tjs en GET
        $code_zone = $_GET['code_zone'];
        if (!_codeZoneExiste($code_zone)) {
            die('le code zone fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
    else {
        die('vous devez fournir un code zone pour voir le livre');
        //header('Location:index.php?c=error&a=e_404');
    }

    $data['zones']     = getList();
    $data['zone']      = getOne($code_zone);
    $data['view_title'] = 'Fiche de la zone: ' . $data['zone']['piece'];
    $html               = $a . $c . '.php';

    return array('data' => $data, 'html' => $html);
}

function _codeZoneExiste($code_zone) 
{
    if (!getCodeZoneCount($code_zone)) {
        return false;
    }
    else {
        return true;
    }
}