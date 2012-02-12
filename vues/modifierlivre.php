<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="titre">
               Titre
        </label>
        <input type="text" name="titre" value="<?php echo ($data['titre']); ?>" />
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities['0']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions[1]); ?>" />
        <input type="hidden" name="id" value="<?php echo ($data['isbn']); ?>" />
         <input type="submit" value="modifier" />
    </fieldset>
</form>