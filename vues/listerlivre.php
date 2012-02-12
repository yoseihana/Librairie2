<h1>
	<?php echo $c;?>
</h1>
 <?php if(count($data)): ?>
<ul>
	<?php foreach($data as $livre): ?>
	<li>
		<?php echo $livre['titre']; ?> <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[1]); ?>&id=<?php echo($livre['isbn']); ?>">modifie</a> - 
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[2]); ?>&id=<?php echo($livre['isbn']); ?>">supprimer</a> - 
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[4]); ?>&id=<?php echo($livre['isbn']); ?>">ajouter</a>
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[3]); ?>&id=<?php echo($livre['isbn']); ?>">voir</a> -
		<?php //echo $livre['nombre_page']; ?>
		<?php //echo $livre['date_parution']; ?>
		<?php //echo $livre['isbn']; ?> 
		<?php //echo $livre['code_zone']; ?>
		<?php //echo $livre['genre']; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>