<?php

session_start();
ini_set('display_errors', 1); //--> erreur dans le code affichée

include ('./config/config.php');
include ('./helpers/url.php');
require_once './controleur/MainController.php';

$view = MainController::route();

include ('./vues/layout.php');