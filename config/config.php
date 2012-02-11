<?php

        $validEntities = array('livre', 'zone', 'auteur'); 
        $validActions = array('lister', 'modifier', 'supprimer', 'voir', 'ajouter');	

        define('DEFAULT_CONTROLLER', $validEntities[0]); // utilisation lorsqu'on vient sur l'application et qu'il n'y a pas de param, par défaut on affiche la liste des livres. Ici livre
	define('DEFAULT_ACTION', $validActions[0]); // par défaut, les livres seront lister. Ici lister
	
	define('DSN','mysql:host=localhost;dbname=bibli'); // le seul endroit où il peut avoir le mysql pour le SGBD, c'est le format type du DSN
	define('USER', 'root');
	define('PASS','root');
	
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Le mode de gestion des erreur de PDO doit ê les exceptions --> lorsqu'il y a une erreur a la bd PDO lance une exception
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch = manière de récupérer les données de la BD ds un format spécifique pr lire en php, ici en tableau associatif
		
	);// Celon qu'on accède a des constantes de class, il faut 2x2pts. Ici on travaille sur la connexion avec la BD pr ércupérer les données à affcihées ds le site
        