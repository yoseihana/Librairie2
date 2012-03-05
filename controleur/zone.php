<?php

include 'modeles/livre.php';
include 'modeles/auteur.php';
include 'modeles/zone.php';


function lister()
{
    global $a, $c;

    $data['view_title'] = 'Liste des zones';
    $data['zones'] = getAllZones(); // !! modifier à regarder partout si c'est pas getAllLivre
    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function modifier()
{
    global $a, $c, $validActions, $validEntities;

    // Récupère l'isbn depuis $_REQUEST avec gestion d'erreurs
    $code_zone = _getCodezoneFromRequest();

    // Test l'existance de l'isbn dans la DB
    _testCodezone($code_zone);

    // POST - modifier le livre en DB
    // GET - données pour le formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $champs['zone']['code_zone'] = $code_zone;
        $champs['zone']['meuble'] = $_POST['meuble'];
        $champs['zone']['piece'] = $_POST['piece'];

        updateBook($champs);

        header('Location:' . voirZoneUrl($code_zone)); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $zone = findZoneByCode($code_zone);

        $data['view_title'] = 'Modification de la zone: ' . $zone['piece'];
        $data['zone'] = $zone; // Le livre à modifier

        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html);
    }
}

function ajouter()
{
    global $a, $c, $validActions, $validEntities;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        add();

        header('Location:' . $_SERVER['PHP_SELF'] . '?a=lister&c=zone'); // donne la page index.php qui est par défaut
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {


        $data['view_title'] = 'Ajout de la zone: ';
        $html = $a . $c . '.php';

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

        header('Location:' . $_SERVER['PHP_SELF'] . '?a=' . $validActions['lister'] . '&c=' . $validEntities['zone'] . '&code_zone=' . $code_zone);
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {

        $data['zone'] = getOne($code_zone);
        $data['view_title'] = 'Supression da zone: ' . $data['zone']['piece'] . ' - ' . $data['zone']['meuble'];
        $html = $a . $c . '.php';

        return array('data' => $data, 'html' => $html); // returne
    }


}

function voir()
{ // récupérer 1x les informations d'1 seul livre
    global $a, $c;

    $code_zone = _getCodezoneFromRequest();
    _testCodezone($code_zone);

    $zone = findZoneByCode($code_zone);

    $data['view_title'] = 'Fiche de la zone: ' . $zone['piece'] . ' - ' . $zone['meuble'];
    $data['zones'] = getAllZones();
    $data['zone'] = $zone; // Le livre à voir
    $data['zone']['livre'] = findBookByZone($zone['code_zone']);

    $html = $a . $c . '.php';
    return array('data' => $data, 'html' => $html);
}

function _getCodezoneFromRequest()
{
    global $a;

    if (!isset($_REQUEST['code_zone']))
    {
        die('vous devez fournir un code zone pour ' . $a . ' une zone');
        //header('Location:index.php?c=error&a=e_404');
    }

    return $_REQUEST['code_zone'];
}

function _testCodezone($code_zone)
{
    if (getCodeZoneCount($code_zone) < 1)
    {
        die('le code zone fournit n\'existe pas dans la base de donnée!');
        //header('Location:index.php?c=error&a=e_404');
    }
}