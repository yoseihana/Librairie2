<?php

        $GLOBALS['validEntities'] = array('livre'=>'livre', 'zone'=>'zone', 'auteur'=>'auteur'); 
        //$GLOBALS['validEntities'] = array('livre', 'zone', 'auteur'); 
       // $GLOBALS['validActions'] = array('lister', 'modifier', 'supprimer', 'voir', 'ajouter', 'deconnecter', 'connecter', 'e_404');	
        $GLOBALS['validActions'] = array('lister'=>'lister'  , 'modifier'=>'modifier', 'supprimer'=>'supprimer', 'voir'=>'voir', 'ajouter'=>'ajouter', 'deconnecter'=>'deconnecter', 'connecter'=>'connecter', 'e_404'=>'e_404');

        define('DEFAULT_CONTROLLER', $GLOBALS['validEntities']['livre']); // utilisation lorsqu'on vient sur l'application et qu'il n'y a pas de param, par défaut on affiche la liste des livres. Ici livre
	define('DEFAULT_ACTION', $GLOBALS['validActions']['lister']); // par défaut, les livres seront lister. Ici lister
	
	define('DSN','mysql:host=localhost;dbname=bibli'); // le seul endroit où il peut avoir le mysql pour le SGBD, c'est le format type du DSN
	define('USER', 'root');
	define('PASS','root');
	
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Le mode de gestion des erreur de PDO doit ê les exceptions --> lorsqu'il y a une erreur a la bd PDO lance une exception
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch = manière de récupérer les données de la BD ds un format spécifique pr lire en php, ici en tableau associatif
		
	);// Celon qu'on accède a des constantes de class, il faut 2x2pts. Ici on travaille sur la connexion avec la BD pr ércupérer les données à affcihées ds le site
        
        $connect = FALSE;