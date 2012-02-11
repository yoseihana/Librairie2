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
            if (isset( $_GET['c'] ))
            {
               if ( in_array ($_GET['c'], $validEntities))
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
                $data  = getList ($connex);
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
           
             if (isset( $_POST['c'] ))
            {
               if ( in_array ($_POST['c'], $validEntities))
               {
                   $c = $_POST['c'];
               }
               else
               {
                   die('Oops mauvais objet');
               }
            };
           
		
             if(isset($_POST['a']))
            {
               if(in_array($_POST['a'], $validActions))
               {
                   $a = $_POST['a'];
               }
               else
               {
                   die('Oops mauvais action'); // lister
               }
            };
            
            include ('./modeles/'.$c.'.php');
            
            if($a == $validActions[1]) // modifier
            {
                $id = $_POST['id'];
                //update($connex, $id);
                
                $data  = getList ($connex);
            }
            elseif ($a == $validActions[2] ) // supprimer
            {
                $id = $_POST['id'];
            }
            elseif ($a == $validActions[3]) // ajouter
            {
                $id = $_POST['id'];
            }
           /* elseif ( $a == $validActions[3]) // voir
            {
            
            }
            elseif ($a == $validActions[4]) //ajouter
            {
            
            } A remettre après */
	}
	
        $view = $a . $c .'.php' ;
        
	include ('./vues/layout.php');