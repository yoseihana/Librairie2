<h1>
	<?php echo $c; ?>
</h1>
<ul>
	<?php foreach($auteurs as $auteur): ?>
	<li>
		<?php echo $auteur['prenom']; ?> 
		<?php echo $auteur['nom']; ?> - 
		<?php echo $auteur['date_naissance']; ?>
	</li>
	<?php endforeach; ?>
</ul>