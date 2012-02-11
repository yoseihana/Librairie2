<?php
	//Contient les fct pr travailler avec la BD de livre

	function getList($c){
		
		$list = '';
		
		$req = 'SELECT * FROM auteur';
		
		$res = $c->query($req); // récupération ds la BD, renvoi un résultat défini par la class PDO_STATEMENT = résultat
		//Fetch pr récupérer un tuple (=ligne) et le transformer ds le FETCH_MOD dtm
		$list = $res->fetchAll(); //ds $list il va y avoir un tableau de tableau associatif
		
		return $list;
	}