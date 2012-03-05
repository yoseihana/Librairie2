<?php if ($connected)
{
    ?>
<h1><?php echo $c . ' a ' . $a; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="piece">
            Pièce:
        </label>
        <br/>
        <input type="text" name="piece" value="<?php echo ($view['data']['zone']['piece']); ?>"/>
        <br/>
        <label for="meuble">
            Meuble:
        </label>
        <br/>
        <input type="text" name="meuble" value="<?php echo ($view['data']['zone']['meuble']); ?>"/>

        <input type="hidden" name="c" value="<?php echo ($validControllers['zone']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['modifier']); ?>"/>
        <input type="hidden" name="code_zone" value="<?php echo ($view['data']['zone']['code_zone']); ?>"/>

        <div class="bouton">
            <input type="submit" value="Modifier"/>
        </div>
    </fieldset>
</form>

<?php
} else
{
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
} ?>