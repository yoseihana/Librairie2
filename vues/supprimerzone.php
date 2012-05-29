<?php if (true)
{
    ?>


<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
    <fieldset>
        <h1>
            <?php echo $view['data']['view_title']; ?>
        </h1>
        <h2>
            Etes-vous sûr de vouloir supprimer cette zone?
        </h2>

        <div class="bouton">
            <input type="submit" value="Supprimer"/>
        </div>

        <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
        <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
        <input type="hidden" name="code_zone" value="<?php echo ($view['data']['zone'][Zone::CODE_ZONE]); ?>"/>
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