<?php

require_once './controleur/LivreController.php';
require_once './controleur/AuteurController.php';
require_once './controleur/ZoneController.php';

abstract class MainController
{
    const DEFAULT_CONTROLLER = 'def_controller';
    const DEFAULT_ACTION = 'def_action';
    const SESSION_CONNECTED = 'connected';

    private static $lastController;
    private static $lastAction;

    //Routage
    public static function route()
    {
        // Define the controller and the action where route to.
        if (isset($_REQUEST['a']) && isset($_REQUEST['c']))
        {
            self::$lastController = $_REQUEST['c'];
            self::$lastAction = $_REQUEST['a'];
        }
        else
        {
            self::$lastController = constant(self::DEFAULT_CONTROLLER);
            self::$lastAction = constant(self::DEFAULT_ACTION);
        }

        // Get supposed controller class name from controller name
        $lastControllerClass = AbstractController::getClassName(self::$lastController);

        if (!class_exists($lastControllerClass, false))
        {
            die('No controller found for "' . self::$lastController . '".');
        }

        //Changement, passe d'un string à un objet instancier de la dernière classe
        $lastControllerClass = new $lastControllerClass;

        // Check if controller class name (above) is a valid controller (extends AbstractController)
        if (!($lastControllerClass instanceof AbstractController))
        {
            die('No valid controller found for "' . self::$lastController . '".');
        }

        // Retrieve all valid action for the given controller
        $availableActions = call_user_func(array(
            $lastControllerClass,
            'getAvailableActions' // Method inherited from AbstractController
        ));

        // Check if requested action is available for the requested controller
        if (!in_array(self::getLastAction(), $availableActions))
        {
            die ('No action "' . self::$lastAction . '" for controller "' . self::$lastController . '"');
        }

        // Call the requested method from the requested controller  /!\ Trés important!
        return call_user_func(array(
            $lastControllerClass,
            self::$lastAction
        ));
    }

    public static function getLastAction()
    {
        return self::$lastAction;
    }

    public static function getLastController()
    {
        return self::$lastController;
    }

    public static function getLastViewFileName()
    {
        return strtolower(self::$lastAction . self::$lastController . '.php');
    }

    public static function isAuthenticated()
    {
        return isset($_SESSION[self::SESSION_CONNECTED]) ? $_SESSION[self::SESSION_CONNECTED] : false;
    }

}
