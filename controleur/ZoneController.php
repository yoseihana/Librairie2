<?php
/**
 * Created by JetBrains PhpStorm.
 * User: annabelle
 * Date: 27/05/12
 * Time: 19:49
 * To change this template use File | Settings | File Templates.
 */

require_once 'AbstractController.php';
require_once './modeles/Zone.php';
require_once './modeles/Book.php';

final class ZoneController extends AbstractController
{
    private $zone;
    private $book;

    function __construct()
    {
        $this->zone = new Zone();
        $this->book = new Book();
    }

    public static function getDefaultAction()
    {
        return 'lister';
    }

    public function lister()
    {
        $data = array(
            'view_title'=> 'Liste des zones',
            'zones'     => $this->zone->getAll()
        );

        return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
    }

    public function voir()
    {
        $code_zone = $this->getParameter('code_zone');
        $this->isZoneExist($code_zone);
        $zone = $this->zone->findZoneByCode($code_zone);

        $data = array(
            'view_title'=> 'Fiche de la zone ' . $zone['piece'] . ' - ' . $zone['meuble'],
            'zone'      => $zone,
            'livre'     => $this->book->findByZone($code_zone)
        );

        return array('data'=> $data, 'html'=> MainController::getLastViewFileName());

    }

    public function supprimer()
    {
        $code_zone = $this->getParameter('code_zone');
        $this->isZoneExist($code_zone);

        if ($this->isPost())
        {
            $this->zone->delete($code_zone);

            header('Location: ' . Url::listerZone());
        }
        elseif ($this->isGet())
        {
            $zone = $this->zone->findZoneByCode($code_zone);
            $data = array(
                'view_title'=> 'Zone a supprimée '. $zone[Zone::PIECE].' - '.$zone[Zone::MEUBLE],
                'zone'      => $zone
            );

            return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
        }
    }

    public function ajouter()
    {
        if ($this->isPost())
        {
            $zone = array(
                Zone::CODE_ZONE=> $this->getParameter('code_zone'),
                Zone::MEUBLE   => $this->getParameter('meuble'),
                Zone::PIECE    => $this->getParameter('piece')
            );

            $this->zone->add($zone);

            header('Location: ' . Url::voirZone($this->getParameter('code_zone')));
        }
        elseif ($this->isGet())
        {
            $data = array(
                'view_title'=> 'Ajouter une zone'
            );

            return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
        }
    }

    public function modifier()
    {
        $code_zone = $this->getParameter('code_zone');
        $this->isZoneExist($code_zone);

        if ($this->isPost())
        {
            $zone = array(
                Zone::CODE_ZONE=> $code_zone,
                Zone::MEUBLE   => $this->getParameter('meuble'),
                Zone::PIECE    => $this->getParameter('piece')
            );

            $this->zone->update($zone);

            header('Location: ' . Url::voirZone($this->getParameter('code_zone')));
        }
        elseif ($this->isGet())
        {
            $zone = $this->zone->findZoneByCode($code_zone);

            $data = array(
                'view_title'=> 'Modification de la zone ' . $zone[Zone::PIECE] . ' - ' . $zone[Zone::MEUBLE],
                'zone'      => $zone,
            );

            return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
        }
    }

    public function isZoneExist($code_zone)
    {
        if ($this->zone->countZoneByCode($code_zone) < 1)
        {
            die('Le code zone ' . $code_zone . ' n\'existe pas');
        }

        return true;
    }
}
