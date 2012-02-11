<h1>
	<?php echo $c; ?>
</h1>
<ul>
	<?php foreach($zones as $zone): ?>
	<li>
		<?php echo $zone['code_zone']; ?>
		(<?php echo $zone['piece']; ?> - 
		<?php echo $zone['meuble']; ?> )
	</li>
	<?php endforeach; ?>
</ul>