<?php
/**
 * Created by JetBrains PhpStorm.
 * User: annabelle
 * Date: 3/06/12
 * Time: 17:16
 * To change this template use File | Settings | File Templates.
 */

require_once './modeles/Membre.php';
require_once 'AbstractController.php';
require_once './helpers/Erreur.php';


final class MembreController extends AbstractController
{
    private $membre;

    function __construct()
    {
        $this->membre = new Membre();
    }

    public static function getDefaultAction()
    {
        return 'connexion';
    }

    public function connexion()
    {
        if ($this->isPost())
        {
            $information = array(
                Membre::MAIL     => $this->getParameter('mail'),
                Membre::PASSWORD => $this->getParameter('mdp')
            );

            $_SESSION[MainController::SESSION_CONNECTED] = $this->membre->authentication($information);

            if (!MainController::isAuthenticated())
            {
                Erreur::erreurLogin();
            }
            else
            {
                header('Location: ' . Url::listerLivre());
            }
        }
        elseif ($this->isGet())
        {
            $data = array(
                'view_title'=> 'Connexion'
            );

            return array('data'=> $data, 'html'=> MainController::getLastViewFileName());
        }
    }

    public function deconnexion()
    {
        session_unset();
        session_destroy();

        header('Location: ' . Url::listerLivre());
    }
}
