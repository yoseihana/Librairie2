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
	
        
        if(  isset ( $_REQUEST['a'] ) && isset ( $_REQUEST['c'] ))
        {
            if( in_array ( $_REQUEST['a'], $GLOBALS['validActions'] ) && in_array ( $_REQUEST['c'], $GLOBALS['validEntities'] ))
            {
                $a = $_REQUEST['a'];
                $c = $_REQUEST['c'];
            }else{
                die('Oops problème');
            }
         }else
         {
               $a = DEFAULT_ACTION;
               $c = DEFAULT_CONTROLLER;
            }
                
  include('controleur/'.$c.'.php');
  
  $view = call_user_func ($a);
                
include ('./vues/layout.php');