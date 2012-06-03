<h1>
    <?php echo $view['data']['view_title'] ?>
</h1>
<div class="voir">
    <?php if (MainController::isAuthenticated()): ?>
    <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
        <fieldset>
            <h2>
                Etes-vous sûr de vouloir supprimer ce livre?
            </h2>

    <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
    <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
    <input type="hidden" name="isbn" value="<?php echo ($view['data']['livre'][Book::ISBN]); ?>"/>

    <div class="bouton">
        <input type="submit" value="Supprimer"/>
    </div>
    <?php else: ?>
    <p>Vous devez vous connecter pour supprimer un livre.</p>
    <?php endif; ?>
</fieldset>
</form>

</div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p class="retour"><a href="<?php echo Url::voirLivre($view['data']['livre'][Book::ISBN]); ?>">Retour à la fiche du
        livre</a></p>
    <?php else: ?>
    <p class="retour"><a href="<?php echo Url::connexionMembre(); ?>">Se connecter</a></p>
    <?php endif; ?>
</div>