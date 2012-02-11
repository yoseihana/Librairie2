<?php
	//Contient les fct pr travailler avec la BD de livre

	function getList($c){
		
		$list = '';
		
		$req = 'SELECT * FROM livre';
		
		$res = $c->query($req); // récupération ds la BD, renvoi un résultat défini par la class PDO_STATEMENT = résultat
		//Fetch pr récupérer un tuple (=ligne) et le transformer ds le FETCH_MOD dtm
		$list = $res->fetchAll(); //ds $list il va y avoir un tableau de tableau associatif
		
		return $list;
	}
	
	function getOne($c, $isbn){
	
		$livre = '';
		
		$req = 'SELECT * FROM livre WHERE isbn = ?'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?
		
		$ps = $c->prepare($req); // prépare la requete
		
		$ps->bindValue(1, $isbn); // Lier l'isbn, si utilisation isbn au lieu du ?, on change 0 en 'isbn', mais ici garantie de ne pas avoir de problème d'injection sql
		
		//$ps->bindParam(0, $isbn); // sera évaluée lorsqu'il y aura la référence à cette valeur
		
		$ps->execute(); // execution 
		
		$livre = $ps->fetchall(); // récupère un résultat
		
		return $livre;
	
	}
	
	function delete($c, $isbn){
		$livre = '';
		
		$req = 'SELECT * FROM liver WHERE isbn = ?';		
		$ps = $c->prepare($req); 
		
		$ps->bindValue(1, $isbn); 		
		$req = $ps->execute(); 
		
		return $livre;
	}