<?php

function listerLivreUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['lister'];
    $params['c'] = $validControllers['livre'];

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function modifierLivreUrl($isbn)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['modifier'];
    $params['c'] = $validControllers['livre'];
    $params['isbn'] = $isbn;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function ajouterLivreUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['ajouter'];
    $params['c'] = $validControllers['livre'];

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function supprimerLivreUrl($isbn)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['supprimer'];
    $params['c'] = $validControllers['livre'];
    $params['isbn'] = $isbn;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

function voirLivreUrl($isbn)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['voir'];
    $params['c'] = $validControllers['livre'];
    $params['isbn'] = $isbn;

    return $_SERVER['PHP_SELF'] . '?' . http_build_query($params);
}

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