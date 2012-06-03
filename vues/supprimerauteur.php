<h1>
    <?php echo $view['data']['view_title']; ?>
</h1>
<div class="voir">
    <?php if (MainController::isAuthenticated()): ?>
    <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
        <fieldset>

            <h2>
                Etes-vous sûr de vouloir supprimer cet auteur?
            </h2>
    <input type="hidden" name="id_auteur" value="<?php echo ($view['data']['auteur']['id_auteur']); ?>"/>

    <div class="bouton">
        <input type="submit" value="Supprimer"/>
    </div>

    <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
    <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
    <input type="hidden" name="id_auteur" value="<?php echo ($view['data']['auteur'][Author::ID_AUTEUR]); ?>"/>
    <?php else: ?>
    <p>Vous devez vous connecter pour supprimer un auteur.</p>
    <?php endif; ?>
</fieldset>
</form>

</div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p class="retour"><a href="<?php echo Url::voirAuteur($view['data']['auteur'][Author::ID_AUTEUR]); ?>">Retour à la
        fiche de l'auteur</a></p>
    <?php else: ?>
    <p class="retour"><a href="<?php echo Url::connexionMembre(); ?>">Se connecter</a></p>
    <?php endif; ?>
</div>