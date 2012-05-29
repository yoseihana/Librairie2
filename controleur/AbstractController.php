<?php

abstract class AbstractController
{
    const SUFFIX = 'Controller';

    public static final function getClassName($controllerName = NULL)
    {
        return ($controllerName) ? $controllerName . self::SUFFIX : get_called_class();
    }

    public static final function getName()
    {
        return strtolower(substr(get_called_class(), 0, -strlen(self::SUFFIX)));
    }

    public static abstract function getDefaultAction();

    public static final function getAvailableActions()
    {
        return array_diff(
            get_class_methods(get_called_class()),
            get_class_methods(get_parent_class(get_called_class()))
        );
    }

    protected final function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected final function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    /**
     * Recherche la valeur du paramètre passer en post ou get dont la clé est passée en argument de la fonction
     * @param $paramKey
     * @return mixed
     */
    protected final function getParameter($paramKey)
    {
        switch ($_SERVER['REQUEST_METHOD'])
        {
            case 'POST' :
                $param = $_POST[$paramKey];
                break;

            case 'GET' :
                $param = $_GET[$paramKey];
                break;

            default :
                $param = $_REQUEST[$paramKey];
        }

        if (!isset($param))
        {
            // TODO use error handling via utils
            die('Parametre manquant : "' . $paramKey . '"'
                . ' pour l\'action "' . MainController::getLastAction() . '"'
                . ' et le controlleur "' . MainController::getLastController() . '".');
        }

        return $param;
    }

}
