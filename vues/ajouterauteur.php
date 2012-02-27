<h1><?php echo $c . ' a ' . $a; ?></h1>
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="nom">
               Nom:
        </label>
        <br/>
        <input type="text" name="nom" value="Nom" />
        <br/>
        <label for="prenom">
               Prénom:
        </label>
        <br/>
        <input type="text" name="prenom" value="Prénom" />
        <br/>
       <label for="id_auteur">
               ID auteur:
        </label>
        <br/>
        <input type="text" name="id_auteur" value="4" />
        <br/>
        <label for="date_naissance">
                Date de naissance:
        </label>
        <br/>
        <input type="text" name="date_naissance" value="YYYY/MM/JJ" />
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities['auteur']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions['ajouter']); ?>" />
        <div class="bouton">
        <input type="submit" value="Ajouter" />
        </div>
    </fieldset>
</form>
