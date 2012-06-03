<?php
/**
 * Created by JetBrains PhpStorm.
 * User: annabelle
 * Date: 3/06/12
 * Time: 15:34
 * To change this template use File | Settings | File Templates.
 */

require_once 'AbstractController.php';

final class ErreurController extends AbstractController
{
    public static function getDefaultAction()
    {
        return 'erreurDefaut';
    }

    public static function erreurDefaut()
    {
        $data = array(
            'view_title'  => 'Erreur',
            'message'     => 'Une erreur est survenue pour votre demande'
        );

        return array('data'=> $data, 'html'=> 'erreur.php');
    }

    public function erreurLogin()
    {
        $data = array(
            'view_title'  => 'Erreur dans le login',
            'message'     => 'Mot de passe ou identifiant inconnu'
        );

        return array('data'=> $data, 'html'=> 'erreur.php');
    }

    public function erreurAction()
    {
        $data = array(
            'view_title'  => 'Erreur dans l\'action',
            'message'     => 'Il n\'y a pas d\'action connu pour ce controlleur.'
        );

        return array('data'=> $data, 'html'=> 'erreur.php');
    }

    public function erreurController()
    {
        $data = array(
            'view_title'  => 'Erreur dans le controlleur',
            'message'     => 'Il n\'y a pas de controlleur connue pour cette demande.'
        );

        return array('data'=> $data, 'html'=> 'erreur.php');
    }

    public function erreurControllerExiste()
    {
        $data = array(
            'view_title'  => 'Erreur du controlleur',
            'message'     => 'Le controlleur demander n\'existe pas'
        );

        return array('data'=> $data, 'html'=> 'erreur.php');
    }

    public function erreuParam()
    {
        $data = array(
            'view_title'  => 'Erreur des paramètres',
            'message'     => 'Un paramètre est manquant pour l\'action et le controlleur demander.'
        );

        return array('data'=> $data, 'html'=> 'erreur.php');
    }

    public function erreurId()
    {
        $data = array(
            'view_title'  => 'Erreur de l\'id',
            'message'     => 'L\'id fourni n\'existe pas dans notre base de donnée'
        );

        return array('data'=> $data, 'html'=> 'erreur.php');
    }
}
