<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="meuble">
              Zone
        </label>
        <input type="text" name="meuble" value="<?php echo ($data['meuble']); ?>" />
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities[1]); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions[1]); ?>" />
        <input type="hidden" name="id" value="<?php echo ($data['code_zone']); ?>" />
         <input type="submit" value="modifier" />
    </fieldset>
</form>
             
