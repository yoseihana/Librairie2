<h1>
	<?php echo $c;?>
</h1>
<?php if(count ( $view['data'] ['livres']) ): ?>
    <ul>
        <?php foreach($view['data']['livres'] as $livre): ?> <!-- Conmpte si il y a au moins 1 livre -->
                <li>
                        <h2><a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['voir']; ?>&isbn=<?php echo($livre['isbn']); ?>"><?php echo $livre['titre']; ?></a>
                            <?php if($connected): ?></h2>
                    <br/>
                        <a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['modifier']; ?>&isbn=<?php echo($livre['isbn']); ?>">Modifier</a> -
                        <a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['supprimer']; ?>&isbn=<?php echo($livre['isbn']); ?>">Supprimer</a>
                            <?php endif; ?>
                </li>
       <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="ajouter">
    <?php if($connected): ?> <p> <a href="?c=<?php echo $GLOBALS['validEntities']['livre']; ?>&a=<?php echo $GLOBALS['validActions']['ajouter']; ?>">Ajouter un livre</a></p><?php endif; ?>
</div>