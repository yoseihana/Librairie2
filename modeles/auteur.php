<?php

	function getList($c){ 
		$req = 'SELECT * FROM auteur'; 
		
                try{
		$res = $c->query($req);
		$auteur = $res->fetchAll();
                }
                catch (PDOException $e){
                    die( $e->getMessage () );
                }
                return $auteur;
	}
	
	function getOne($c, $id_auteur){
		
		$req = 'SELECT * FROM auteur WHERE id_auteur = :id_auteur';
		
                try{
		$ps = $c->prepare($req);
		
		$ps->bindValue(':id_auteur', $id_auteur); 
		$ps->execute(); 
		
		$auteur = $ps->fetch(); 
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		return $auteur;
	
	}
	
	function delete($c, $id_auteur){
		$req = 'DELETE FROM auteur WHERE id_auteur = :id_auteur'; 
                
                try{
                    $ps = $c->prepare($req); 
		
                    $ps->bindValue(':id_auteur', $id_auteur);
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
	}
        
        function update ($c, $id_auteur){
		
		$req = 'UPDATE auteur SET nom = :nom WHERE id_auteur = :id_auteur'; 
                
                try{
                    $ps = $c->prepare($req); 
		
                    $ps->bindValue(':id_auteur', $id_auteur);
                    $ps->bindValue( ':nom', $_POST['nom'] );
		
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
        }
        
         
        function add ($c){

		
		$req = 'INSERT INTO auteur value ( :id_auteur, :nom, :prenom, :date_naissance)';
		
                try{
		$ps = $c->prepare($req); 
		
		$ps->bindValue(':id_auteur', $id_auteur); 
                $ps->bindValue (':nom', $_POST['nom']);
                $ps->bindValue (':prenom', $_POST['prenom']);
                $ps->bindValue (':date_naissance', $_POST['date_naissance']);
		
		$ps->execute();
		
		$livre = $ps->fetch(); 
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		return $auteur;
        }