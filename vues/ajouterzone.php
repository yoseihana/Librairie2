<h1><?php echo $view['data']['view_title']; ?></h1>
<div class="voir">
    <?php if (MainController::isAuthenticated()) : ?>
    <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
        <fieldset>
            <label for="cd">
                Code Zone
            </label>
            <br/>
            <input type="text" id="cd" name="code_zone"
                   value="<?php echo isset($view['data']['zone']['code_zone']) ? $view['data']['zone']['code_zone'] : 'bd'; ?>"/>
            <br/>
            <label for="p">
                Piece
            </label>
            <br/>
            <input type="text" id="p" name="piece"
                   value="<?php echo isset($view['data']['zone']['piece']) ? $view['data']['zone']['piece'] : 'Salon'; ?>"/>
            <br/>
            <label for="m">
                Meuble
            </label>
            <br/>
            <input type="text" id="m" name="meuble"
                   value="<?php echo isset($view['data']['zone']['meuble']) ? $view['data']['zone']['meuble'] : 'commode jaune'; ?>"/>
            <br/>
            <input type="submit" value="Ajouter"/>
            <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
            <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
        </fieldset>
    </form>
    <?php else: ?>
    <p>Vous devez vous connecter pour ajouter une zone.</p>
    <?php endif; ?>
</div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p class="retour"><a href="<?php echo Url::listerZone(); ?>">Retour à liste des zones</a></p>
    <?php else: ?>
    <p class="retour"><a href="<?php echo Url::connexionMembre(); ?>">Se connecter</a></p>
    <?php endif; ?>
</div>