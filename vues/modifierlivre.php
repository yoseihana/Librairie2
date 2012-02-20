<h1><?php echo $c. ' a '. $a; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="titre">
               Titre
        </label>
        <input type="text" name="titre" value="<?php echo ($view['data']['titre']); ?>" />
        <label for="nombre_page">
               Nombre de page
        </label>
        <input type="text" name="nombre_page" value="<?php echo ($view['data']['nombre_page']); ?>" />
        <label for="date_parution">
              Date de parution
        </label>
        <input type="text" name="date_parution" value="<?php echo ($view['data']['date_parution']); ?>" />
        <label for="genre">
               Genre
        </label>
        <select name="genre">
            <option value=""><?php echo ($view['data']['genre']); ?></option>
            <option value="">theatre</option>
            <option value="">roman</option>
            <option value="">historique</option>
            <option value="">fantastique</option>

        </select>
    
        
        <input type="hidden" name="c" value="<?php echo ($validEntities[0]); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions[1]); ?>" />
        <input type="hidden" name="id" value="<?php echo ($view['data']['isbn']); ?>" />
         <input type="submit" value="modifier" />
    </fieldset>
</form>