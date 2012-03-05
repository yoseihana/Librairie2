<?php if ($connected): ?>
<h1><?php echo $c . ' a ' . $a; ?></h1>
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <label for="titre">
            Titre:
        </label>
        <br/>
        <input type="text" name="titre" value="Titre"/>
        <br/>
        <label for="isbn">
            ISBN:
        </label>
        <br/>
        <input type="text" name="isbn" value="123-4567-8901-2"/>
        <br/>
        <label for="date">
            Date de parution:
        </label>
        <br/>
        <input type="text" name="date_parution" value="YYYY"/>
        <br/>
        <label for="nombre">
            Nombre de page:
        </label>
        <br/>
        <input type="text" name="nombre_page" value="1234"/>
        <br/>
        <label for="genre">
            Genre:
        </label>
        <br/>
        <select name="genre" id="genre">
            <option value="roman">
                Roman
            </option>
            <option value="policier">
                Policier
            </option>
            <option value="historique">
                Historique
            </option>
            <option value="théâtre">
                Théâtre
            </option>
            <option value="fantastique">
                Fantastique
            </option>
        </select>
        <br/>
        <label for="zone">
            Zone:
        </label>
        <br/>
        <select name="code_zone" id="zone">
            <?php foreach ($view['data']['zones'] as $zone): ?>
            <option value="<?php echo $zone['code_zone']; ?>"><?php echo $zone['piece'] . ' - ' . $zone['meuble']; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="auteur">
            Auteur:
        </label>
        <br/>
        <select name="id_auteur" id="auteur">
            <?php foreach ($view['data']['auteurs'] as $auteur): ?>
            <option value="<?php echo $auteur['id_auteur']; ?>"><?php echo $auteur['nom'] . ' ' . $auteur['prenom']; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="image">
            Ajouter une image
        </label>
        <br/>
        <input type="file" name="file" id="image">

        <input type="hidden" name="c" value="<?php echo ($validControllers['livre']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['ajouter']); ?>"/>

        <div class="bouton">
            <input type="submit" value="Ajouter"/>
        </div>
    </fieldset>
</form>
<?php else:
    // Redirection vers la page de login ou une page d'erreur, c'est pas mieux ?
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
endif; ?>