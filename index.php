<?php

session_start();



	ini_set('display_errors',1); //--> erreur dans le code affichée
	
	include ('./config/config.php'); 

            //Connexion bdd. Idem pour le blog tjs le même routage
                // try catch est l'opération de coonnexion à la bd
	try{
		$connex = new PDO(DSN, USER, PASS, $options); //new pr mettre un objet en mémoire, l'instancier. PDO prend 4 valeurs $dsn, $username, $passw, $option --> connexion a la bd
		$connex->query('SET CHARACTER SET UTF8'); // -> = invoquer
		$connex->query('SET NAMES UTF8'); // faire à chaque fois pr l'encodage
	
	}
        catch(PDOException $e) // on type l'exception $e pr pvr afficher le message d'erreur
	{
		die($e->getMessage()); // La -> est l'opérateur d'accession en php, accéder au méthode et propriété de la classe. Plus tard on peut faire une page de message d'erreur mais ici le script s'arrête
                //header('Location: index.php?c=error&a=e_databse'); cible le controleur d'erreur et l'action e de base de donnée
        }// ds ce cas-ci, si une des données est erronées, message d'erreur (par ex user 'oot' ds config.php), l'erreur est donc plus lisible pour nous, on sait où elle est, la gestion est plus propre
	
        
        //Routage
        if(  isset ( $_REQUEST['a'] ) && isset ( $_REQUEST['c'] ))//récupère les paramètre dans l'url
        {
            if( in_array ( $_REQUEST['a'], $GLOBALS['validActions'] ) && in_array ( $_REQUEST['c'], $GLOBALS['validEntities'] ))
            {
                $a = $_REQUEST['a'];
                $c = $_REQUEST['c'];
                
            }else{
                
                die('a et ou c ne sont pas valides');
                //header('Location:index.php?c=error&a=e_404');
            }
         }
         else
         {
               $a = DEFAULT_ACTION; // lister
               $c = DEFAULT_CONTROLLER; //livre
         }
                
  include('controleur/'.$c.'.php');// charge le bon controleur necessaire
  
  $view = call_user_func ($a); // appel la fct correspondant à l'action donnée, call_user_func appel une autre fct avec le nom $a lister(lister) et retourne la valeur ds $view
 //$view retourn $view['data'] : les données pr ma vue et $view['html']: le nom de ma vue, est retourné en 
  
  $connected = isset($_SESSION['connected']) ? $_SESSION['connected'] : false;
  
include ('./vues/layout.php');