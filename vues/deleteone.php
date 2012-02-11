<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html	xmlns="http://www.w3.org/1999/xhtml"
		xml:lang="fr-BE"
		lang="fr-BE">
		
	<head>
		<meta 	http-equiv="Content-Type"
				content="text/html; charset=utf-8" />
		<meta 	http-equiv="Content-Style-Type"
				content="text/css" />
		<meta 	http-equiv="Content-Language"
				content="fr" />

		<title>
			Bibliothèque
		</title>
		
		<link	rel="stylesheet"
				type="text/css"
				href=""
				media="screen"
				title="Normal" />
	</head>
	
	<body>
		<h1>
			Formulaire de suppression
		</h1>
		<form method="post" action="index.php">
			<label for="title">
				Titre
			</label>
			<input type="text" name="titre" value="Titre" id="title"/>
			<label for="date">
				Date parution
			</label>
			<input type="text" name="parution" value="parution" id="date"/>
			<label for="isbn">
				ISBN
			</label>
			<input type="text" name="numisbn" value="ISBN" id="isbn" />
			<label for="genre">
				Genre
			</label>
			<select>
				<option>Roman</option>
				<option>Policier</option>
				<option>Historique</option>
				<option>Théâtre</option>
				<option>Fantastique</option>
			</select>
			<label for="page">
				Nombre page
			</label>
			<input type="text" name="nombre" value="nombre" id="page"/>
			<input type="button" name="ajouter" value="Ajouter" />
			<!-- faire une boucle foreach pour placer les éléments dans du php et placer un input type hidden pour stocker l'isbn du livre -->
		</form>	
	</body>
</html>