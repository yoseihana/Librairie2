<?php

	function getList($c){ 
		$req = 'SELECT * FROM zone'; 
		
                try{
		$res = $c->query($req);
		$zone = $res->fetchAll();
                }
                catch (PDOException $e){
                    die( $e->getMessage () );
                }
                return $zone;
	}
	
	function getOne($c, $code_zone){
		
		$req = 'SELECT * FROM zone WHERE code_zone = :code_zone';
		
                try{
		$ps = $c->prepare($req);
		
		$ps->bindValue(':code_zone', $code_zone); 
		$ps->execute(); 
		
		$zone = $ps->fetch(); 
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		return $zone;
	
	}
	
	function delete($c, $code_zone){
		$req = 'DELETE FROM zone WHERE code_zone = :code_zone'; 
                
                try{
                    $ps = $c->prepare($req); 
		
                    $ps->bindValue(':code_zone', $code_zone);
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
	}
        
        function update ($c, $code_zone){
		
		$req = 'UPDATE zone SET meuble = :meuble WHERE code_zone = :code_zone'; 
                
                try{
                    $ps = $c->prepare($req); 
		
                    $ps->bindValue(':code_zone', $code_zone);
                    $ps->bindValue( ':meuble', $_POST['meuble'] );
		
                    $ps->execute();  
		
                    
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		
                return true;
        }
        
         
        function add ($c){

		
		$req = 'INSERT INTO zone value ( :code_zone, :piece, :meuble)';
		
                try{
		$ps = $c->prepare($req); 
		
		$ps->bindValue(':code_zone', $code_zone); 
                $ps->bindValue (':piece', $_POST['piece']);
                $ps->bindValue (':meuble', $_POST['meuble']);
		
		$ps->execute();
		
		$livre = $ps->fetch(); 
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
		return $zone[0];
        }