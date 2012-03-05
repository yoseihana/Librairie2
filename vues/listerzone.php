<h1>
    <?php echo $c; ?>
</h1>
<?php if (count($view['data'] ['zones'])): ?>
<ul>
    <?php foreach ($view['data']['zones'] as $zone): ?>
    <li>
        <h2><a href="<?php echo voirZoneUrl($zone['code_zone']); ?>"><?php echo $zone['piece'] . ' - ' . $zone['meuble']; ?></a></h2>
        <br/>
        <?php if ($connected): ?>
        <a href="<?php echo modifierZoneUrl($zone['code_zone']); ?>">Modifier</a> -
        <a href="<?php echo supprimerZoneUrl($zone['code_zone']); ?>">Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<div class="ajouter">
    <?php if ($connected): ?> <p><a href="<?php echo ajouterZoneUrl($zone['code_zone']); ?>">Ajouter une zone</a></p><?php endif; ?>
</div>
<?php endif; ?>   
