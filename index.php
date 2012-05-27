<?php

session_start();


ini_set('display_errors', 1); //--> erreur dans le code affichée

include ('./config/config.php');
include ('./helpers/Url.php');

$view = MainController::route();


$connected = isset($_SESSION['connected']) ? $_SESSION['connected'] : false;

include ('./vues/layout.php');