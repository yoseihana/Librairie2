<?php if ($connected)
{ ?>
<h1><?php echo $c . ' a ' . $a; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="nom">
            Nom:
        </label>
        <br/>
        <input type="text" name="nom" value="<?php echo ($view['data']['auteur']['nom']); ?>"/>
        <br/>
        <label for="prenom">
            Prénom:
        </label>
        <br/>
        <input type="text" name="prenom" value="<?php echo ($view['data']['auteur']['prenom']); ?>"/>
        <br/>
        <label for="date_naissance">
            Date de naissance:
        </label>
        <br/>
        <input type="text" name="date_naissance" value="<?php echo ($view['data']['auteur']['date_naissance']); ?>"/>

        <input type="hidden" name="c" value="<?php echo ($validEntities['auteur']); ?>"/>
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