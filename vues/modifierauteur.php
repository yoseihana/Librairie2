<?php if ($connected)
{
    ?>
<h1><?php echo $c . ' a ' . $a; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="nom">
            Nom:
        </label>
        <br/>
        <input type="text" name="nom" id="nom" value="<?php echo ($view['data']['auteur']['nom']); ?>"/>
        <br/>
        <label for="prenom">
            Prénom:
        </label>
        <br/>
        <input type="text" name="prenom" id="prenom" value="<?php echo ($view['data']['auteur']['prenom']); ?>"/>
        <br/>
        <label for="date_naissance">
            Date de naissance:
        </label>
        <br/>
        <input type="text" name="date_naissance" id="date_naissance" value="<?php echo ($view['data']['auteur']['date_naissance']); ?>"/>

        <input type="hidden" name="c" value="<?php echo ($validControllers['auteur']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['modifier']); ?>"/>
        <input type="hidden" name="id_auteur" value="<?php echo ($view['data']['auteur']['id_auteur']); ?>"/>

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