<h1>
    <?php echo $c . ' a ' . $a; ?>
</h1>
<h2>
    Etes-vous sûr de vouloir supprimer ce livre?
</h2>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="POST">
    <fieldset>
        <h3>
               Titre:
        </h3>
        <p class="supprimer">"<?php echo ($view['data']['livre']['titre']); ?>"</p>
        
        <input type="hidden" name="c" value="<?php echo ($validEntities['livre']); ?>" />
        <input type="hidden" name="a" value="<?php echo ($validActions['supprimer']); ?>" />
        <input type="hidden" name="isbn" value="<?php echo ($view['data']['livre']['isbn']); ?>" />
        <div class="bouton">
            <input type="submit" value="Supprimer" />
        </div>
    </fieldset>
</form>