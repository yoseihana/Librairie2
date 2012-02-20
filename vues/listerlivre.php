<h1>
	<?php echo $c;?>
</h1>
<?php if(count ( $view['data'] ['livres']) ): ?>
    <ul>
        <?php foreach($view['data']['livres'] as $livre): ?> <!-- Conmpte si il y a au moins 1 livre -->
                <li>
                        <a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['voir']; ?>&isbn=<?php echo($livre['isbn']); ?>"><?php echo $livre['titre']; ?></a> <?php //if($connected): ?> 
                        <a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['modifier']; ?>&isbn=<?php echo($livre['isbn']); ?>">modifier</a> -
                        <a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['supprimer']; ?>&isbn=<?php echo($livre['isbn']); ?>">supprimer</a> -
                        <a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['ajouter']; ?>&isbn=<?php echo($livre['isbn']); ?>">ajouter</a> -
                </li>
       <?php endforeach; ?>
    </ul>
<?php endif; ?>      