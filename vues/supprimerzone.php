<h1>
    <?php echo $view['data']['view_title']; ?>
</h1>
<div class="voir">
    <?php if (MainController::isAuthenticated()): ?>
    <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
        <fieldset>
            <h2>
                Etes-vous sûr de vouloir supprimer cette zone?
            </h2>

    <div class="bouton">
        <input type="submit" value="Supprimer"/>
    </div>

    <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
    <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
    <input type="hidden" name="code_zone" value="<?php echo ($view['data']['zone'][Zone::CODE_ZONE]); ?>"/>
    <?php else: ?>
    <p>Vous devez vous connecter pour supprimer un livre.</p>
    <?php endif; ?>
</fieldset>
</form>
</div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p class="retour"><a href="<?php echo Url::voirZone($view['data']['zone'][Zone::CODE_ZONE]); ?>">Retour à la fiche
        de la zone</a></p>
    <?php else: ?>
    <p class="retour"><a href="<?php echo Url::connexionMembre(); ?>">Se connecter</a></p>
    <?php endif; ?>
</div>