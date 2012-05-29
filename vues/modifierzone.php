<?php if (true)
{
    ?>
<h1><?php echo $view['data']['view_title']; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="piece">
            Pièce:
        </label>
        <br/>
        <input type="text" id="piece" name="piece" value="<?php echo ( $view['data']['zone'][Zone::PIECE]); ?>"/>
        <br/>
        <label for="meuble">
            Meuble:
        </label>
        <br/>
        <input type="text" id="meuble" name="meuble" value="<?php echo ( $view['data']['zone'][Zone::MEUBLE]); ?>"/>

        <div class="bouton">
            <input type="submit" value="Modifier"/>
        </div>

        <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
        <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
        <input type="hidden" name="code_zone" value="<?php echo $view['data']['zone'][Zone::CODE_ZONE] ?>"/>
    </fieldset>
</form>
<div class="ajouter">
    <?php if (true): ?>
    <p class="retour"><a href="<?php echo Url::voirZone($view['data']['zone'][Zone::CODE_ZONE]); ?>">Retour à la fiche de la zone</a></p>
    <?php endif; ?>
</div>
<?php
}
else
{
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
} ?>