<h1>
    <?php echo $c; ?>
</h1>
<?php if (count($view['data'] ['zones'])): ?>
    <ul>
        <?php foreach ($view['data']['zones'] as $zone): ?>
            <li>
               <h2> <a href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['voir']; ?>&code_zone=<?php echo($zone['code_zone']); ?>"><?php echo $zone['piece'] . ' - ' . $zone['meuble']; ?></a></h2>
               <br/>
                <?php if ($connected): ?>
                    <a href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['modifier']; ?>&code_zone=<?php echo($zone['code_zone']); ?>">Modifier</a> -
                    <a href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['supprimer']; ?>&code_zone=<?php echo($zone['code_zone']); ?>">Supprimer</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<div class="ajouter">
<?php if($connected): ?> <p> <a href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['ajouter']; ?>">Ajouter une zone</a></p><?php endif; ?>
</div>
<?php endif; ?>   
