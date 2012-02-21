<h1><?php echo $c. ' a '. $a; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="titre">
               Titre
        </label>
        <input type="text" name="titre" value="<?php echo ($view['data']['livre']['titre']); ?>" />
        <label for="nombre_page">
               Nombre de page
        </label>
        <input type="text" name="nombre_page" value="<?php echo ($view['data']['livre']['nombre_page']); ?>" />
        <label for="date_parution">
              Date de parution
        </label>
        <select name="date_parution" id="date_parution">
            <?php for($year=1901; $year<2155; $year++): ?>
            <option <?php if($year == $view['data']['livre']['date_parution']): ?> 
                        selected="selected" 
                    <?php endif; ?> 
                        value="<?php echo $year; ?>">
                <?php echo $year; ?>
             </option>
            <?php endfor;?>
        </select>
        <label for="genre">
               Genre
        </label>
         <select name="genre" id="genre">
            <?php $genre=$_GET['genre']; 
            for($i=0; $i<6; $i++): ?>
            <option <?php if($genre[$i] == $genre['data']['livre']['genre']): ?> 
                        selected="selected" 
                    <?php endif; ?> 
                        value="<?php echo $genre; ?>">
                <?php echo $genre; ?>
             </option>
            <?php endfor;?>
        </select>
        
        <input type="hidden" name="c" value="<?php echo ($validEntities['livre']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions['modifier']); ?>" />
        <input type="hidden" name="isbn" value="<?php echo ($view['data']['livre']['isbn']); ?>" />
         <input type="submit" value="modifier" />
    </fieldset>
</form>