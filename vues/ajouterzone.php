<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="code_zone">
               Code Zone
        </label>
        <input type="text" name="code_zone" value="s1" />
        <label for="piece">
               Piece
        </label>
        <input type="text" name="piece" value="Salon" />
        <label for="meuble">
               Meuble
        </label>
        <input type="text" name="meuble" value="Commode blanche" />
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities['zone']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions['ajouter']); ?>" />
         <input type="submit" value="ajouter" />
    </fieldset>
</form>