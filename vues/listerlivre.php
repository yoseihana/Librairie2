<h1>
	<?php echo $c;?>
</h1>
<?php if(count ( $view['data'] ) ): ?>
<ul>
	<?php foreach($view['data'] as $livre): ?>
	<li>
		<?php echo $livre['titre']; ?>
                <?php echo $livre['nombre_page']; ?>
                <?php echo $livre['date_parution']; ?>
                <?php echo $livre['genre']; ?>
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[1]); ?>&id=<?php echo($livre['isbn']); ?>">modifie</a> - 
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[2]); ?>&id=<?php echo($livre['isbn']); ?>">supprimer</a> - 
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[4]); ?>&id=<?php echo($livre['isbn']); ?>">ajouter</a> -
                <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[3]); ?>&id=<?php echo($livre['isbn']); ?>">voir</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>