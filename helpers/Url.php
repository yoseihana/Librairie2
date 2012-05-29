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

    /*--------------------- LIVRE --------------------*/
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

    /*----------------- AUTEUR -----------------------*/
    public static function listerAuteur()
    {
        return Url::build(AuteurController::getName(), 'lister');
    }

    public static function voirAuteur($id_auteur)
    {
        return Url::build(AuteurController::getName(), 'voir', array('id_auteur'=> $id_auteur));
    }

    public static function modifierAuteur($id_auteur)
    {
        return Url::build(AuteurController::getName(), 'modifier', array('id_auteur'=> $id_auteur));
    }

    public static function supprimerAuteur($id_auteur)
    {
        return Url::build(AuteurController::getName(), 'supprimer', array('id_auteur'=> $id_auteur));
    }

    public static function ajouterAuteur()
    {
        return Url::build(AuteurController::getName(), 'ajouter');
    }

    /*-----------------ZONE --------------------->*/
    public static function listerZone()
    {
        return Url::build(ZoneController::getName(), 'lister');
    }

    public static function voirZone($code_zone)
    {
        return Url::build(ZoneController::getName(), 'voir', array('code_zone'=> $code_zone));
    }

    public static function modifierZone($code_zone)
    {
        return Url::build(ZoneController::getName(), 'modifier', array('code_zone'=> $code_zone));
    }

    public static function ajouterZone()
    {
        return Url::build(ZoneController::getName(), 'ajouter');
    }

    public static function supprimerZone($code_zone)
    {
        return Url::build(ZoneController::getName(), 'supprimer', array('code_zone'=> $code_zone));
    }
}

