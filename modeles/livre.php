<?php
	//Contient les fct pr travailler avec la BD de livre. Aller chercher dans la BD

	function getList(){ // récupère une liste de livre
		
		global $connex ; // permet de récupérer un var ds une fonction. On se conncet a la bdd
                
                $req = 'SELECT titre, isbn
                        FROM livre
                        ORDER BY titre' ;
		
                try{
                    
                    $res = $connex->query($req); // récupération ds la BD, renvoi un résultat défini par la class PDO_STATEMENT = résultat
		//Fetch pr récupérer un tuple (=ligne) et le transformer ds le FETCH_MOD dtm
                    $livres = $res->fetchAll(); //ds $livres il va y avoir un tableau de tableau associatif ac comme clef les noms des tables (isbn, nb_page...)
                }
                catch (PDOException $e)
                {
                    die( $e->getMessage () );// intéressant en phase développement lorsqu'on a une application, on fait une page qui reprend les erreurs
                    // header(Location: index.php?c=error&a=e_database');
                    
                }

                return $livres;
	}
	
	function getOne($isbn){ // récupère un livre
            
                global $connex ;
		
		$req = 'SELECT * FROM livre WHERE isbn = :isbn'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée

                try
                {
                    $ps = $connex->prepare($req); // prépare la requete
                    $ps->bindValue(':isbn', $isbn); // Lier l'isbn, si utilisation isbn au lieu du ?, on change 0 en 'isbn', mais ici garantie de ne pas avoir de problème d'injection sql
                    $ps->execute(); // execution 

                    $livre = $ps->fetch(); // récupère un résultat, 1 seul livre
                
                }
                catch(PDOException $e) // si il y a un problème, une exception
                {
                    die($e->getMessage());
                    //header ('Location: index.php?c=erreor&a=e_database');
                }
                
		return $livre; // ne fonctionnais pas sans le 0
	
	}
	
	function delete($isbn){
                global $connex ;
                
		$req = 'DELETE FROM livre WHERE isbn = :isbn'; 
                
                try
                {
                    $ps = $connex->prepare($req); 
		
                    $ps->bindValue(':isbn', $isbn);
		
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
	}
        
        function update ($isbn){
		
                global $connex ;
            
		$req = 'UPDATE livre SET titre = :titre, nombre_page = :nombre_page, date_parution = :date_parution, genre = :genre WHERE isbn = :isbn'; 
                
                try{
                    $ps = $connex->prepare($req); 
		
                    $ps->bindValue(':isbn', $isbn);
                    $ps->bindValue( ':titre', $_POST['titre'] );
                    $ps->bindValue( ':nombre_page', $_POST['nombre_page'] );
                    $ps->bindValue( ':date_parution', $_POST['date_parution'] );
                    $ps->bindValue( ':genre', $_POST['genre'] );
		
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
        }
        
         
        function add (){

                global $connex ;
            
		$req = 'INSERT INTO livre value ( :isbn, :titre, :date_parution, :nombre_page, null, null)'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée
		
                try{
		$ps = $connex->prepare($req); 
		
		$ps->bindValue(':isbn', $_POST['isbn']); 
                $ps->bindValue (':titre', $_POST['titre']);
                $ps->bindValue (':date_parution', $_POST['date_parution']);
                $ps->bindValue (':nombre_page', $_POST['nombre_page']);
		
		$ps->execute();
		
		$livre = $ps->fetch(); 
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		return $livre[0];
        }
        
        function getISBNCount ($isbn)
        {
            global $connex; // récupérer la connection
            $req = 'SELECT count(isbn) AS nb_isbn FROM livre WHERE isbn = :isbn'; // récupère le nbre d'isbn

            try
            {
                $ps = $connex->prepare ( $req ) ; // connection
                $ps->bindValue ( ':isbn', $isbn ) ; //les valeurs sont liées
                $ps->execute () ; // execution
            }
            catch (PDOException $e)
            {
                die($e->getMessage());
                //header ('Location: index.php?c=error&a=e_database');
            }

            $nbIsbn = $ps->fetch();
            $nbIsbn = $nbIsbn['nb_isbn']; // extraction du nbre de ISBN trouver

            return $nbIsbn['nb_isbn']; // retourne 0 ou 1
        }