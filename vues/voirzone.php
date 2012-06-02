<h1>
    <?php echo ($view['data']['view_title']); ?>
</h1>
<div class="voir">
    <h3>
        Pièce:
    </h3>

    <p><?php echo($view['data']['zone'][Zone::PIECE]); ?></p>

    <h3>
        Meuble:
    </h3>

    <p><?php echo($view['data']['zone'][Zone::MEUBLE]); ?> </p>

    <h3>
        Livre dans cette zone:
    </h3>
    <?php if (count($view['data']['livres']) < 1): ?>
        <p>Il n'y a pas de livres sur cette commode</p>
    <?php else: ?>
        <?php foreach ($view['data']['livres'] as $livres): ?>
            <p><?php echo $livres[Book::TITRE]; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="ajouter">
    <?php if (true): ?>
    <p><a href="<?php echo Url::modifierZone($view['data']['zone'][Zone::CODE_ZONE]); ?>">Modifier la zone</a></p>
    <p><a href="<?php echo Url::supprimerZone($view['data']['zone'][Zone::CODE_ZONE]); ?>">Supprimer la Zone</a></p>
    <p><a href="<?php echo Url::ajouterZone(); ?>">Ajouter une zone</a></p>
    <p class="retour"><a href="<?php echo Url::listerZone(); ?>">Retour à liste des zones</a></p>
    <?php endif; ?>
</div>
