<?php

final class Url
{
    /**
     * Méthode générique utilisée pour contruire toute les Urls
     * @static
     * @param $controller
     * @param $action
     * @param array|null $params
     * @return string
     */
    private static function build($controller, $action, array $params = array())
    {
        $p = array(
            'c' => $controller,
            'a' => $action
        );

        return $_SERVER['PHP_SELF'] . '?' . http_build_query(array_merge($p, $params));
    }


    /**
     * Retourne l'url pour lister les livres
     * @static
     * @return string
     */
    public static function listerLivre()
    {
        return Url::build(LivreController::getName(), 'lister');
    }

    /**
     * Retourne l'url pour modifier un livre
     * @static
     * @param $isbn
     * @return string
     */
    public static function modifierLivre($isbn)
    {
        return Url::build(LivreController::getName(), 'modifier', array(
            'isbn' => $isbn
        ));
    }

    /**
     * Retourne l'url pour voir un livre
     * @param $isbn
     * @return string
     */
    public static function voirLivre($isbn)
    {
        return Url::build(LivreController::getName(), 'voir', array(
            'isbn' => $isbn
        ));
    }

    /**
     * Retourne l'url pour supprimer un livre
     * @static
     * @param $isbn
     * @return string
     */
    public static function supprimerLivre($isbn)
    {
        return Url::build(LivreController::getName(), 'supprimer', array(
            'isbn' => $isbn
        ));
    }

    /**
     * Retourne l'url pour ajouter un livre
     * @static
     * @return string
     */
    public static function ajouterLivre()
    {
        return Url::build(LivreController::getName(), 'ajouter');
    }
}

/* TODO
 * Les fonctions ci-dessous doivent passer dans la classe Url au fur et à mesure de la migration des controlleurs en classes
 */

function listerAuteurUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['lister'];
    $params['c'] = $validControllers['auteur'];

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function voirAuteurUrl($id_auteur)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['voir'];
    $params['c'] = $validControllers['auteur'];
    $params['id_auteur'] = $id_auteur;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function modifierAuteurUrl($id_auteur)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['modifier'];
    $params['c'] = $validControllers['auteur'];
    $params['id_auteur'] = $id_auteur;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function supprimerAuteurUrl($id_auteur)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['supprimer'];
    $params['c'] = $validControllers['auteur'];
    $params['id_auteur'] = $id_auteur;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function ajouterAuteurUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['ajouter'];
    $params['c'] = $validControllers['auteur'];

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function listerZoneUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['lister'];
    $params['c'] = $validControllers['zone'];

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function modifierZoneUrl($code_zone)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['modifier'];
    $params['c'] = $validControllers['zone'];
    $params['code_zone'] = $code_zone;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function ajouterZoneUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['ajouter'];
    $params['c'] = $validControllers['zone'];

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function supprimerZoneUrl($code_zone)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['supprimer'];
    $params['c'] = $validControllers['zone'];
    $params['code_zone'] = $code_zone;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function voirZoneUrl($code_zone)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['voir'];
    $params['c'] = $validControllers['zone'];
    $params['code_zone'] = $code_zone;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}
