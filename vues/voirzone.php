<h1>
    <?php echo $c; ?>
</h1>
<?php if (count($view['data'] ['zones'])): ?>
<ul>
    <?php foreach ($view['data']['zones'] as $zone): ?> <!-- Conmpte si il y a au moins 1 livre -->
    <li>
        <h2><a
            href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['voir']; ?>&code_zone=<?php echo($zone['code_zone']); ?>"><?php echo $zone['piece'] . ' - ' . $zone['meuble']; ?></a>
        </h2>
        <?php if ($connected): ?>
        <a href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['modifier']; ?>&code_zone=<?php echo($zone['code_zone']); ?>">Modifier</a>
        -
        <a href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['supprimer']; ?>&code_zone=<?php echo($zone['code_zone']); ?>">Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<div class="voir">
    <h3>
        Pièce
    </h3>

    <p><?php echo($view['data']['zone']['piece']); ?></p>

    <h3>
        Meuble
    </h3>

    <p><?php echo($view['data']['zone']['meuble']); ?> </p>
</div>
<div class="ajouter">
    <?php if ($connected): ?><a
    href="?c=<?php echo $GLOBALS['validEntities']['zone']; ?>&a=<?php echo $GLOBALS['validActions']['ajouter']; ?>&code_zone=<?php echo($zone['code_zone']); ?>">Ajouter
    une zone</a> <?php endif; ?>
</div>