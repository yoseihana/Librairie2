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


<p>
    Etes-vous sûr de vouloir supprimer ce livre?
</p>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="titre">
               Titre
        </label>
        <p> <?php echo ($data['titre']); ?> </p>
        
        <input type="hidden" name="c" value="<?php echo ($validEntities['0']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions[4]); ?>" />
       <!-- <input type="hidden" name="id" value="<//?php echo ($data['isbn']); ?>" />-->
         <input type="submit" value="Supprimer" />
    </fieldset>
</form>
             
         </body>