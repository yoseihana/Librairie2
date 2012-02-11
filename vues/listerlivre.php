<h1>
	<?php //echo $c; ?>
</h1>
 <?php if(count($data)): ?>
<ul>
	<?php foreach($data as $livre): ?>
	<li>
		<?php echo $livre['titre']; ?> <a href="?c=livres&a=deleteone&isbn=<?php echo $livre['isbn']; ?>">supprimer</a> - <a href="?c=livres&a=udpateone&isbn=<?php echo $livre['isbn']; ?>">modifie</a>
		<?php echo $livre['nombre_page']; ?>
		<?php echo $livre['date_parution']; ?>, 
		<?php echo $livre['isbn']; ?>, 
		<?php echo $livre['code_zone']; ?>, 
		<?php echo $livre['genre']; ?>-->
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>