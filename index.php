<?php

	ini_set('display_errors',1); //--> erreur dans le code affichée
	
	include ('./config/config.php');
	
	try{
		$connex = new PDO(DSN, USER, PASS, $options); //new pr mettre un objet en mémoire, l'instancier. PDO prend 4 valeurs $dsn, $username, $passw, $option
		$connex->query('SET CHARACTER SET UTF8');
		$connex->query('SET NAMES UTF8'); // faire à chaque fois pr l'encodage
	
	}catch(PDOException $e)
	{
		die($e->getMessage()); // La -> est l'opérateur d'accession en php, accéder au méthode et propriété de la classe
	}// ds ce cas-ci, si une des données est erronées, message d'erreur (par ex user 'oot' ds config.php), l'erreur est donc plus lisible pour nous, on sait où elle est, la gestion est plus propre
	
	if( $_SERVER['REQUEST_METHOD'] == 'GET' ) // Dtm si la requête est en get ou en post 
	{
				
			$c = isset($_GET['c']) ? $_GET['c'] : DEFAULT_CONTROLLER;
			$a = isset($_GET['a']) ? $_GET['a'] : DEFAULT_ACTION;
			
			$content = $a.$c.'.php';
		
		if( !@include ( './modeles/'.$c.'.php' )){ include ('./vues/'.DEFAULT_CONTROLLER.'.php');}; 
			//include ('./modeles/'.$c.'.php'); / './vues/404.php'
			
		if( $a == 'lister'){
		
			$$c = getList($connex);
			
		}elseif ( $a == 'updateone' ){
		
			$isbn = $_GET['isbn'];
			$$c = getOne($connex, $isbn);
			
		}elseif( $a == 'deleteone'){
			
			$isbn = $_GET['isbn'];
			$$c = getOne($connex, $isbn);
			
		}
			
	}/*else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	;
	}*/
	
	include ('./vues/layout.php');