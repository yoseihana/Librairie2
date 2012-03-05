<h1>
    <?php echo $c; ?>
</h1>
<?php if (count($view['data'] ['zones'])): ?>
<ul>
    <?php foreach ($view['data']['zones'] as $zone): ?> <!-- Conmpte si il y a au moins 1 livre -->
    <li>
        <h2><a
            href="<?php echo voirZoneUrl($zone['code_zone']); ?>"><?php echo $zone['piece'] . ' - ' . $zone['meuble']; ?></a>
        </h2>
        <?php if ($connected): ?>
        <a href="<?php echo modifierZoneUrl($zone['code_zone']); ?>">Modifier</a>
        -
        <a href="<?php echo supprimerZoneUrl($zone['code_zone']); ?>">Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<div class="voir">
    <h3>
        Pièce:
    </h3>

    <p><?php echo($view['data']['zone']['piece']); ?></p>

    <h3>
        Meuble:
    </h3>

    <p><?php echo($view['data']['zone']['meuble']); ?> </p>

    <h3>
        Livre dans cette zone:
    </h3>

    <p><?php echo($view['data']['zone']['livre']['titre']) ?></p>
</div>
<div class="ajouter">
    <?php if ($connected): ?><a
    href="<?php echo ajouterZoneUrl($zone['code_zone']); ?>">Ajouter
    une zone</a> <?php endif; ?>
</div>