<?php

abstract class MainController
{
    const DEFAULT_CONTROLLER = 'def_controller';
    const DEFAULT_ACTION = 'def_action';

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
            die('No valid controller found for "' . self::$lastController . '".');
        }
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

        // Call the requested method from the requested controller
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

}
