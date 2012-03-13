<?php if ($connected)
{
    ?>
<h1><?php echo $c . ' a ' . $a; ?></h1>
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <label for="nom">
            Nom:
        </label>
        <br/>
        <input type="text" name="nom" value="Nom" id="nom"/>
        <br/>
        <label for="prenom">
            Prénom:
        </label>
        <br/>
        <input type="text" name="prenom" value="Prénom" id="prenom"/>
        <br/>
        <label for="date_naissance">
            Date de naissance:
        </label>
        <br/>
        <input type="text" name="date_naissance" value="YYYY/MM/JJ" id="date_naissance"/>
        <br/>
        <label for="fichier">
            Ajouter une image
        </label>
        <br/>
        <input type="file" name="fichier" id="fichier">


        <input type="hidden" name="c" value="<?php echo ($validControllers['auteur']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['ajouter']); ?>"/>
        <input type="hidden" name="image" value="<?php echo $view['data']['auteur']['image'] ?>"/>

        <div class="bouton">
            <input type="submit" value="Ajouter"/>
        </div>
    </fieldset>
</form>
<?php
} else
{
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
} ?>