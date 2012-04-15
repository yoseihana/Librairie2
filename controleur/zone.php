<?php

include 'modeles/zone.php';

class C_zone
{

    function __construct()
    {
        $this->zone = new M_zone();
    }

    function lister()
    {
        global $a, $c;

        $data['view_title'] = 'Liste des zones';
        $data['zones'] = $this->zone->getAllZones(); // !! modifier à regarder partout si c'est pas getAllLivre
        $html = $a . $c . '.php';
        return array('data' => $data, 'html' => $html);
    }

    function modifier()
    {
        global $a, $c;

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

            updateZone($champs);

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
        global $a, $c;

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $code_zone = $_POST['code_zone'];

            $champs['zone']['code_zone'] = $code_zone;
            $champs['zone']['piece'] = $_POST['piece'];
            $champs['zone']['meuble'] = $_POST['meuble'];

            if (countZoneByCode($code_zone) > 0)
            {
                $champs['view_title'] = 'Ajout de la zone: ';
                $champs['erreur'] = 'code_zone "' . $code_zone . '" existe déjà';

                $html = $a . $c . '.php';
                return array('data' => $champs, 'html' => $html);
            }

            addZone($champs);

            header('Location:' . listerZoneUrl()); // donne la page index.php qui est par défaut
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
        global $a, $c;

        $code_zone = _getCodezoneFromRequest();
        _testCodezone($code_zone);

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            deleteZone($code_zone);

            header('Location:' . listerZoneUrl());
        }
        elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $zone = findZoneByCode($code_zone);

            $data['view_title'] = 'Supression da zone: ' . $zone['piece'] . ' - ' . $zone['meuble'];
            $data['zone'] = $zone;

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
        $data['zone']['livre'] = findBooksByZone($zone['code_zone']);

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
        if (countZoneByCode($code_zone) < 1)
        {
            die('le code zone fournit n\'existe pas dans la base de donnée!');
            //header('Location:index.php?c=error&a=e_404');
        }
    }
}