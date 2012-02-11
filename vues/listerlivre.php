<h1>
	<?php //echo $c;?>
</h1>
 <?php if(count($data)): ?>
<ul>
	<?php foreach($data as $livre): ?>
	<li>
		<?php echo $livre['titre']; ?> <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[1]); ?>&id=<?php echo($livre['isbn']); ?>">modifie</a> - <a href="?c=<?php echo ($c); ?>&a=<?php echo ($a); ?>&id=<?php echo($livre['isbn']); ?>">s</a>
		<?php //echo $livre['nombre_page']; ?>
		<?php //echo $livre['date_parution']; ?>, 
		<?php //echo $livre['isbn']; ?>, 
		<?php //echo $livre['code_zone']; ?>, 
		<?php //echo $livre['genre']; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>