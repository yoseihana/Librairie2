<?php

	define('DEFAULT_CONTROLLER', 'livres'); // utilisation lorsqu"on vient sur l'application et qu'il n'y a pas de param, par défaut on affiche la liste des livres
	define('DEFAULT_ACTION', 'lister'); // par défaut, les livres seront lister
	
	define('DSN','mysql:host=localhost;dbname=bibli'); // le seul endroit où il peut avoir le mysql pour le SGBD, c'est le format type du DSN
	define('USER', 'root');
	define('PASS','root');
	
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Le mode de gestion des erreur de PDO doit ê les exceptions
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Récupérer les données de la BD ds un format spécifique pr lire en php, ici en tableau associatif
		
	);// Celon qu'on accède a des constantes de class, il faut 2x2pts. 