<h1>
	<?php echo $c;?>
</h1>
 <?php if(count($data)): ?>
<ul>
	<?php foreach($data as $zone): ?> 
	<li>
		<?php echo $zone['meuble']; ?> <a href="?c=<?php echo ($c); ?>&a=<?php echo ($validActions[1]); ?>&id=<?php echo($zone['code_zone']); ?>">modifie</a> - <a href="?c=<?php echo ($c); ?>&a=<?php echo ($a); ?>&id=<?php echo($zone['code_zone']); ?>">supprimer</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>