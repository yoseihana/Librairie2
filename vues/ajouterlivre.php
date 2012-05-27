<?php if (TRUE): ?>
<h1><?php echo $view['data']['view_title'] ?></h1>
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        <label for="titre">
            Titre:
        </label>
        <br/>
        <input type="text" id="titre" name="titre" value="Titre"/>
        <br/>
        <label for="isbn">
            ISBN:
        </label>
        <br/>
        <input type="text" id="isbn" name="isbn" value="123-4567-8901-2"/>
        <br/>
        <label for="date">
            Date de parution:
        </label>
        <br/>
        <input type="text" id="date" name="date_parution" value="YYYY"/>
        <br/>
        <label for="nombre">
            Nombre de page:
        </label>
        <br/>
        <input type="text" id="nombre" name="nombre_page" value="1234"/>
        <br/>
        <label for="genre">
            Genre:
        </label>
        <br/>
        <select name="genre" id="genre">
            <!-- Ici nous pouvons appeler directement Book, car la liste des genres n'est pas liée à la BDD (donc invariable) -->
            <?php foreach (Book::getAllGenres() as $genre): ?>
            <option><?php echo $genre ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="zone">
            Zone:
        </label>
        <br/>
        <select name="code_zone" id="zone">
            <?php foreach ($view['data']['zones'] as $zone): ?>
            <option
                value="<?php echo $zone[Zone::CODE_ZONE]; ?>"><?php echo $zone[Zone::PIECE] . ' - ' . $zone[Zone::MEUBLE]; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="auteur">
            Auteur:
        </label>
        <br/>
        <select name="id_auteur" id="auteur">
            <?php foreach ($view['data']['auteurs'] as $auteur): ?>
            <option
                value="<?php echo $auteur[Author::ID_AUTEUR]; ?>"><?php echo $auteur[Author::NOM] . ' ' . $auteur[Author::PRENOM]; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="fichier">
            Ajouter une image
        </label>
        <br/>
        <input type="file" name="fichier" id="fichier">

        <input type="hidden" name="image" value="<?php echo $view['data']['livre'][Book::IMAGE] ?>"/>

        <div class="bouton">
            <input type="submit" value="Ajouter"/>
        </div>
    </fieldset>
</form>
<?php
else:
    // Redirection vers la page de login ou une page d'erreur, c'est pas mieux ?
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
endif; ?>