<?php if (true) : ?>
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
    <fieldset>
        <h1>
            <?php echo $view['data']['view_title'] ?>
        </h1>

        <h2>
            Etes-vous sûr de vouloir supprimer ce livre?
        </h2>

        <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
        <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
        <input type="hidden" name="isbn" value="<?php echo ($view['data']['livre'][Book::ISBN]); ?>"/>

        <div class="bouton">
            <input type="submit" value="Supprimer"/>
        </div>
    </fieldset>
</form>
<div class="ajouter">
    <?php if (true): ?>
    <p class="retour"><a href="<?php echo Url::voirLivre($view['data']['livre'][Book::ISBN]); ?>">Retour à la fiche du livre</a></p>
    <?php endif; ?>
</div>
<?php
else:
    // Redirection vers la page de login ou une page d'erreur, c'est pas mieux ?
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
endif; ?>