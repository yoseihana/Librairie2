<?php if ($connected)
{
    ?>
<h1><?php echo $c . ' a ' . $a; ?></h1>

<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <label for="titre">
            Titre:
        </label>
        <br/>
        <input type="text" name="titre" id="titre" value="<?php echo ($view['data']['livre']['titre']); ?>"/>
        <br/>
        <label for="nombre_page">
            Nombre de page:
        </label>
        <br/>
        <input type="text" name="nombre_page" id="nombre_page" value="<?php echo ($view['data']['livre']['nombre_page']); ?>"/>
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
            <option <?php if ('roman' == $view['data']['livre']['genre']): ?>selected="selected"<?php endif; ?>value="roman">Roman</option>
            <option <?php if ('policier' == $view['data']['livre']['genre']): ?>selected="selected"<?php endif; ?>value="policier">Policier</option>
            <option <?php if ('historique' == $view['data']['livre']['genre']): ?>selected="selected"<?php endif; ?>value="historique">Historique</option>
            <option <?php if ('théâtre' == $view['data']['livre']['genre']): ?>selected="selected"<?php endif; ?>value="théâtre">Théâtre</option>
            <option <?php if ('fantastique' == $view['data']['livre']['genre']): ?>selected="selected"<?php endif; ?>value="fantastique">Fantastique</option>
        </select>
        <br/>
        <label for="zone">
            Zone :
        </label>
        <br/>
        <select name="code_zone" id="zone">
            <?php foreach ($view['data']['zones'] as $zone): ?>
            <option <?php if ($view['data']['livre']['code_zone'] == $zone['code_zone']): ?>selected="selected"<?php endif;?> value="<?php echo $zone['code_zone']; ?>"><?php echo $zone['piece'] . ' - ' . $zone['meuble']; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="auteur">
            Auteur :
        </label>
        <br/>
        <select name="id_auteur" id="auteur">
            <?php foreach ($view['data']['auteurs'] as $auteur): ?>
            <option <?php if ($view['data']['livre']['auteur']['id_auteur'] == $auteur['id_auteur']): ?>selected="selected"<?php endif;?> value="<?php echo $auteur['id_auteur']; ?>"><?php echo $auteur['nom'] . ' ' . $auteur['prenom']; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>


        <label for="fichier">
            Ajouter une image
        </label>
        <br/>
        <input type="file" name="fichier" id="fichier"/>

        <input type="button" value="envoyer"/>
        <?php echo'<img src="../img/' . $name . '" alt="image" />'; ?>

        <input type="hidden" name="photo" value="<?php echo$view['data'][''] ?>"/>
        <input type="hidden" name="c" value="<?php echo ($validControllers['livre']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['modifier']); ?>"/>
        <input type="hidden" name="isbn" value="<?php echo ($view['data']['livre']['isbn']); ?>"/>

        <div class="bouton">
            <input type="submit" value="Modifier"/>
        </div>
    </fieldset>
</form>
<?php
} else
{
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
} ?>