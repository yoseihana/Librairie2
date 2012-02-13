<?php
	//Contient les fct pr travailler avec la BD de livre

	function getList($c){ // récupère une liste de livre
		
		//$list = '';
		
		$req = 'SELECT * FROM livre'; // requêtes SQL pr avoir les livres
		
                try{
		$res = $c->query($req); // récupération ds la BD, renvoi un résultat défini par la class PDO_STATEMENT = résultat
		//Fetch pr récupérer un tuple (=ligne) et le transformer ds le FETCH_MOD dtm
		$livres = $res->fetchAll(); //ds $livres il va y avoir un tableau de tableau associatif ac comme clef les noms des tables (isbn, nb_page...)
                }
                catch (PDOException $e){
                    die( $e->getMessage () );// intéressant en phase développement lorsqu'on a une application, on fait une page qui reprend les erreurs
                }
		//return $list;
                return $livres;
	}
	
	function getOne($c, $isbn){ // récupère un livre
	
		$livre = '';
		
		$req = 'SELECT * FROM livre WHERE isbn = :isbn'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée
		
                try{
		$ps = $c->prepare($req); // prépare la requete
		
		$ps->bindValue(':isbn', $isbn); // Lier l'isbn, si utilisation isbn au lieu du ?, on change 0 en 'isbn', mais ici garantie de ne pas avoir de problème d'injection sql
		
		//$ps->bindParam(0, $isbn); // sera évaluée lorsqu'il y aura la référence à cette valeur
		
		$ps->execute(); // execution 
		
		$livre = $ps->fetchall(); // récupère un résultat, 1 seul livre
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		return $livre[0]; // ne fonctionnais pas sans le 0
	
	}
	
	function delete($c, $isbn){
		$req = 'DELETE FROM livre WHERE isbn = :isbn'; 
                
                try{
                    $ps = $c->prepare($req); 
		
                    $ps->bindValue(':isbn', $isbn);
		
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
	}
        
        function update ($c, $isbn){
		
		$req = 'UPDATE livre SET titre = :titre WHERE isbn = :isbn'; 
                
                try{
                    $ps = $c->prepare($req); 
		
                    $ps->bindValue(':isbn', $isbn);
                    $ps->bindValue( ':titre', $_POST['titre'] );
		
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
        }
        
         
        function add ($c){

		
		$req = 'INSERT INTO livre value ( :isbn, :titre, :date_parution, :nombre_page, null, null)'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée
		
                try{
		$ps = $c->prepare($req); 
		
		$ps->bindValue(':isbn', $_POST['isbn']); 
                $ps->bindValue (':titre', $_POST['titre']);
                $ps->bindValue (':date_parution', $_POST['date_parution']);
                $ps->bindValue (':nombre_page', $_POST['nombre_page']);
		
		$ps->execute();
		
		$livre = $ps->fetchall(); 
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		return $livre[0];
        }