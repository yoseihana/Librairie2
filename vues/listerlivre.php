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


<h1>
	<?php echo $c;?>
</h1>
 <?php if(count($data)): ?>
<ul>
	<?php foreach($data as $livre): ?>
	<li>
		<?php echo $livre['titre']; ?> <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[1]); ?>&id=<?php echo($livre['isbn']); ?>">modifie</a> - 
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[2]); ?>&id=<?php echo($livre['isbn']); ?>">supprimer</a> - 
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[4]); ?>&id=<?php echo($livre['isbn']); ?>">ajouter</a> -
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[3]); ?>&id=<?php echo($livre['isbn']); ?>">voir</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>

         </body>