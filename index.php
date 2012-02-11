<?php

	ini_set('display_errors',1); //--> erreur dans le code affichée
	
	include ('./config/config.php');

                // try catch est l'opération de coonnexion à la bd
	try{
		$connex = new PDO(DSN, USER, PASS, $options); //new pr mettre un objet en mémoire, l'instancier. PDO prend 4 valeurs $dsn, $username, $passw, $option --> connexion a la bd
		$connex->query('SET CHARACTER SET UTF8'); // -> = invoquer
		$connex->query('SET NAMES UTF8'); // faire à chaque fois pr l'encodage
	
	}catch(PDOException $e) // on type l'exception $e pr pvr afficher le message d'erreur
	{
		die($e->getMessage()); // La -> est l'opérateur d'accession en php, accéder au méthode et propriété de la classe. Plus tard on peut faire une page de message d'erreur mais ici le script s'arrête
	}// ds ce cas-ci, si une des données est erronées, message d'erreur (par ex user 'oot' ds config.php), l'erreur est donc plus lisible pour nous, on sait où elle est, la gestion est plus propre
	
        
	if( $_SERVER['REQUEST_METHOD'] == 'GET' ) // Dtm si la requête est en get ou en post 
	{
				
			/*$c = isset($_GET['c']) ? $_GET['c'] : DEFAULT_CONTROLLER;
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
			
		}*/
            
            if(isset($_GET['c']))
            {
               if(in_array($_GET['c'], $validEntities))
               {
                   $c = $_GET['c'];
               }
               else
               {
                   die('Oops mauvais objet');
               }
            }
            else{
                $c = DEFAULT_CONTROLLER; // livres
            };
		
             if(isset($_GET['a']))
            {
               if(in_array($_GET['a'], $validActions))
               {
                   $a = $_GET['a'];
               }
               else
               {
                   die('Oops mauvais action'); // lister
               }
            }
            else{
                $a = DEFAULT_ACTION;
            };
            
            include ('./modeles/'.$c.'.php');
            
            if($a == $validActions[0]) // action lister
            {
                $data = getList ($connex);
            }
            elseif ($a == $validActions[1] || $c == $validActions[3]) // modifier ou|| voir récupération id
            {
                $id = $_GET['id'];
                $data = getOne($connex, $id);
            }
            /*elseif ($a == $validActions[2]) // supprimer
            {
             
            }
            elseif ( $a == $validActions[3]) // voir
            {
            
            }
            elseif ($a == $validActions[4]) //ajouter
            {
            
            } A remettre après */
            
	}else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	;
	}
	
        $view = $a . $c .'.php';
        
	include ('./vues/layout.php');