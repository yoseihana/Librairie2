<?php

require_once 'DB.php';
require_once './controleur/MainController.php';
require_once './controleur/LivreController.php';
require_once './helpers/Uploader.php';
require_once './helpers/Resizer.php';

// DB Config (PDO)
define(DB::DRIVER, 'mysql');
define(DB::HOST, 'localhost');
define(DB::NAME, 'bibli');
define(DB::USER, 'root');
define(DB::PASSWORD, 'root');

define(MainController::DEFAULT_CONTROLLER, LivreController::getName());
define(MainController::DEFAULT_ACTION, LivreController::getDefaultAction());

$validExtentions = array(
    image_type_to_extension(IMAGETYPE_JPEG, false), 'jpg',
    image_type_to_extension(IMAGETYPE_GIF, false),
    image_type_to_extension(IMAGETYPE_PNG, false)
);

$upload_dir = './vues/img/';

$imgUploader = new Uploader($upload_dir, $validExtentions, 1024 * 1024 * 50);
$imgResizer = new Resizer($upload_dir, 10, 20);