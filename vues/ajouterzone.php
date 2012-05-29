<?php if (true) : ?>
<h1><?php echo $view['data']['view_title']; ?></h1>
<?php if (isset($view['data']['erreur'])): ?><h1><?php echo $view['data']['erreur']; ?></h1><?php endif; ?>
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
        <input type="text" id="m" name="meuble" value="<?php echo isset($view['data']['zone']['meuble']) ? $view['data']['zone']['meuble'] : 'commode jaune'; ?>"/>
        <br/>
        <input type="submit" value="Ajouter"/>
        <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
        <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
    </fieldset>
</form>
<div class="ajouter">
    <?php if (true): ?>
    <p class="retour"><a href="<?php echo Url::listerZone(); ?>">Retour à la liste des zones</a></p>
    <?php endif; ?>
</div>
<?php else: ?>
<p>Vous devez vous connecter pour acceder à cette page </p>
<?php endif; ?>