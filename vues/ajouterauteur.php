<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="id_auteur">
               ID auteur
        </label>
        <input type="text" name="id_auteur" value="<?php echo ($view['data']['id_auteur']); ?>" />
        <label for="nom">
               Nom
        </label>
        <input type="text" name="nom" value="<?php echo ($view['data']['nom']); ?>" />
        <label for="prenom">
               Prénom
        </label>
        <input type="text" name="prenom" value="<?php echo ($view['data']['prenom']); ?>" />
         <label for="date_naissance">
               Date de naissance
        </label>
        <input type="text" name="date_naissance" value="<?php echo ($view['data']['date_naissance']); ?>" />
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities[2]); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions[4]); ?>" />
        <input type="hidden" name="id" value="<?php echo ($view['data']['id_auteur']); ?>" />
         <input type="submit" value="Ajouter" />
    </fieldset>
</form>