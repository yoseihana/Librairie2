<?php

// DB Config (PDO)
define(DB::DRIVER, 'mysql');
define(DB::HOST, 'localhost');
define(DB::NAME, 'bibli');
define(DB::USER, 'root');
define(DB::PASSWORD, 'root');

$validControllers = array(
    'livre' => 'livre',
    'zone' => 'zone',
    'auteur' => 'auteur',
    'membre' => 'membre',
    'error' => 'error'
);
$validActions = array(
    'lister' => 'lister',
    'modifier' => 'modifier',
    'supprimer' => 'supprimer',
    'voir' => 'voir',
    'ajouter' => 'ajouter',
    'deconnecter' => 'deconnecter',
    'connecter' => 'connecter',
    'e_404' => 'e_404',
    'e_database' => 'e_database',
    'e_user' => 'e_user'
);

$validExtentions = array(
    'jpg',
    'png',
    'jpeg',
    'JPEG',
    'gif');

$upload_dir = './img';

define('DEFAULT_CONTROLLER', $validControllers ['livre']); // utilisation lorsqu'on vient sur l'application et qu'il n'y a pas de param, par défaut on affiche la liste des livres. Ici livre
define('DEFAULT_ACTION', $validActions['lister']); // par défaut, les livres seront lister. Ici lister


$connected = FALSE; // remettre à false quand la connexion sera ok