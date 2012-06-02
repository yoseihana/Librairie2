<h1>
    <?php echo $view['data']['view_title']; ?>
</h1>
<div class="voir">
    <?php if (count($view['data'] ['zones'])): ?>
    <ul>
        <?php foreach ($view['data']['zones'] as $zone): ?>
        <li>
            <h2>
                <a href="<?php echo Url::voirZone($zone[Zone::CODE_ZONE]); ?>"><?php echo $zone[Zone::PIECE] . ' - ' . $zone[Zone::MEUBLE]; ?></a>
            </h2>
            <br/>
            <?php if (true): ?>
            <a href="<?php echo Url::modifierZone($zone[Zone::CODE_ZONE]); ?>">Modifier</a> -
            <a href="<?php echo Url::supprimerZone($zone[Zone::CODE_ZONE]); ?>">Supprimer</a>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<div class="ajouter">
    <?php if (true): ?> <p><a href="<?php echo Url::ajouterZone(); ?>">Ajouter une zone</a></p><?php endif; ?>
</div>
<div class="pagination">
    <?php for ($i = 1; $i <= $view['data']['nbPage']; $i++): ?>
    <a href="index.php?a=lister&c=zone&page=<?php echo $i ?>"><?php echo $i ?></a>
    <?php endfor; ?>
</div>