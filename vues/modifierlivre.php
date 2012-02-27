<h1><?php echo $c . ' a ' . $a; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="titre">
            Titre:
        </label>
        <br/>
        <input type="text" name="titre" value="<?php echo ($view['data']['livre']['titre']); ?>" />
        <br/>
        <label for="nombre_page">
            Nombre de page:
        </label>
        <br/>
        <input type="text" name="nombre_page" value="<?php echo ($view['data']['livre']['nombre_page']); ?>" />
        <br/>
        <label for="date_parution">
            Date de parution:
        </label>
        <br/>
        <select name="date_parution" id="date_parution">
            <?php for ($year = 1901; $year < 2155; $year++): ?>
                <option <?php if ($year == $view['data']['livre']['date_parution']): ?> 
                        selected="selected" 
                    <?php endif; ?> 
                    value="<?php echo $year; ?>">
                        <?php echo $year; ?>
                </option>
            <?php endfor; ?>
        </select>
        <br/>
        <label for="genre">
            Genre:
        </label>
        <br/>
        <select name="genre" id="genre">
            <option <?php if ('roman' == $view['data']['livre']['genre']): ?> 
                    selected="selected" 
                <?php endif; ?> 
                value="roman">
                Roman
            </option>
            <option <?php if ('policier' == $view['data']['livre']['genre']): ?> 
                    selected="selected" 
                <?php endif; ?> 
                value="policier">
                Policier
            </option>
            <option <?php if ('historique' == $view['data']['livre']['genre']): ?> 
                    selected="selected" 
                <?php endif; ?> 
                value="historique">
                Historique
            </option>
            <option <?php if ('théâtre' == $view['data']['livre']['genre']): ?> 
                    selected="selected" 
                <?php endif; ?> 
                value="théâtre">
                Théâtre
            </option>
            <option <?php if ('fantastique' == $view['data']['livre']['genre']): ?> 
                    selected="selected" 
                <?php endif; ?> 
                value="fantastique">
                Fantastique
            </option>

        </select>

        <input type="hidden" name="c" value="<?php echo ($validEntities['livre']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions['modifier']); ?>" />
        <input type="hidden" name="isbn" value="<?php echo ($view['data']['livre']['isbn']); ?>" />
        <div class="bouton">
            <input type="submit" value="Modifier" />
        </div>
    </fieldset>
</form>