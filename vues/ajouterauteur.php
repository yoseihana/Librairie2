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
         <body>


<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="id_auteur">
               ID auteur
        </label>
        <input type="text" name="id_auteur" value="<?php echo ($data['id_auteur']); ?>" />
        <label for="nom">
               Nom
        </label>
        <input type="text" name="nom" value="<?php echo ($data['nom']); ?>" />
        <label for="prenom">
               Prénom
        </label>
        <input type="text" name="prenom" value="<?php echo ($data['prenom']); ?>" />
         <label for="date_naissance">
               Date de naissance
        </label>
        <input type="text" name="date_naissance" value="<?php echo ($data['date_naissance']); ?>" />
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities[2]); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions[4]); ?>" />
        <input type="hidden" name="id" value="<?php echo ($data['id_auteur']); ?>" />
         <input type="submit" value="Ajouter" />
    </fieldset>
</form>
         </body>