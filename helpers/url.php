<?php

function listerLivreUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['lister'];
    $params['c'] = $validControllers['livre'];

    return $_SERVER['PHP_SELF'].'?'.http_build_query($params);
}

function modifierLivreUrl($isbn)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['modifier'];
    $params['c'] = $validControllers['livre'];
    $params['isbn'] = $isbn;

    return $_SERVER['PHP_SELF'].'?'.http_build_query($params);
}

function ajouterLivreUrl()
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['ajouter'];
    $params['c'] = $validControllers['livre'];

    return $_SERVER['PHP_SELF'].'?'.http_build_query($params);
}

function supprimerLivreUrl($isbn)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['voir'];
    $params['c'] = $validControllers['livre'];
    $params['isbn'] = $isbn;

    return $_SERVER['PHP_SELF'].'?'.http_build_query($params);
}

function voirLivreUrl($isbn)
{
    global $validActions, $validControllers;

    $params['a'] = $validActions['voir'];
    $params['c'] = $validControllers['livre'];
    $params['isbn'] = $isbn;

    return $_SERVER['PHP_SELF'].'?'.http_build_query($params);
}