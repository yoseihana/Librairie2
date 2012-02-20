<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="titre">
               Titre
        </label>
        <input type="text" name="titre" value="<?php echo ($view['data']['titre']); ?>" />
        <label for="isbn">
               ISBN
        </label>
        <input type="text" name="isbn" value="<?php echo ($view['data']['isbn']); ?>" />
        <label for="date">
               Date de parution
        </label>
        <input type="text" name="date_parution" value="<?php echo ($view['data']['date_parution']); ?>" />
        <label for="nombre">
               Nombre de page
        </label>
        <input type="text" name="nombre_page" value="<?php echo ($view['data']['nombre_page']); ?>" />
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities['0']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions[4]); ?>" />
        <input type="hidden" name="id" value="<?php echo ($view['data']['isbn']); ?>" />
         <input type="submit" value="Ajouter" />
    </fieldset>
</form>