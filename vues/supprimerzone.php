<?php if ($connected)
{
    ?>
<h1>
    <?php echo $c . ' a ' . $a; ?>
</h1>
<h2>
    Etes-vous sûr de vouloir supprimer cette zone?
</h2>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
    <fieldset>
        <h3>
            Pièce
        </h3>

        <p> <?php echo ($view['data']['zone']['piece'] . ' - ' . $view['data']['zone']['meuble']); ?> </p>

        <input type="hidden" name="c" value="<?php echo ($validControllers['zone']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['supprimer']); ?>"/>
        <input type="hidden" name="code_zone" value="<?php echo ($view['data']['zone']['code_zone']); ?>"/>

        <div class="bouton">
            <input type="submit" value="Supprimer"/>
        </div>
    </fieldset>
</form>
<?php
} else
{
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
} ?>