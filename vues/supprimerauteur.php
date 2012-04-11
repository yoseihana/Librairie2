<?php if ($connected)
{
    ?>
<h1>
    <?php echo $c . ' a ' . $a; ?>
</h1>
<h2>
    Etes-vous sûr de vouloir supprimer cet auteur?
</h2>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
    <fieldset>
        <h3>
            Nom
        </h3>

        <p class="supprimer"> <?php echo ($view['data']['auteur']['prenom'] . ' ' . $view['data']['auteur']['nom']); ?> </p>

        <input type="hidden" name="c" value="<?php echo ($validControllers['auteur']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['supprimer']); ?>"/>
        <input type="hidden" name="id_auteur" value="<?php echo ($view['data']['auteur']['id_auteur']); ?>"/>

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