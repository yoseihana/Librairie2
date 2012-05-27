<?php

require_once 'DB.php';
require_once './controleur/MainController.php';
require_once './controleur/LivreController.php';

// DB Config (PDO)
define(DB::DRIVER, 'mysql');
define(DB::HOST, 'localhost');
define(DB::NAME, 'bibli');
define(DB::USER, 'root');
define(DB::PASSWORD, 'root');

define(MainController::DEFAULT_CONTROLLER, LivreController::getName());
define(MainController::DEFAULT_ACTION, LivreController::getDefaultAction());

$validExtentions = array(
    'jpg',
    'png',
    'jpeg',
    'JPEG',
    'gif');

$upload_dir = './img';

$connected = TRUE; // remettre à false quand la connexion sera ok