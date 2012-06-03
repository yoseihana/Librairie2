<h1><?php echo $view['data']['view_title']; ?></h1>
<div class="voir">
    <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
        <fieldset>
            <label for="mail">
                Email
            </label>
            <br/>
            <input type="text" id="mail" name="mail" value=""/>
            <br/>
            <label for="mdp">
                Mot de passe
            </label>
            <br/>
            <input type="text" id="mdp" name="mdp" value=""/>
            <br/>
            <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
            <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
            <input type="submit" value="Connexion">
        </fieldset>
    </form>
</div>
<div class="ajouter">
    <?php if (true): ?>
    <p class="retour"><a href="<?php echo Url::listerLivre(); ?>">Retour à la liste des livres</a></p>
    <?php endif; ?>
</div>