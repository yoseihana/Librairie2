<h1 xmlns="http://www.w3.org/1999/html"><?php echo $view['data']['view_title']; ?></h1>
<div class="voir">
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
    <?php if (MainController::isAuthenticated()): ?>
    <fieldset>
        <label for="titre">
            Titre:
        </label>
        <br/>
        <input type="text" name="titre" id="titre" size="30"
               value="<?php echo ($view['data']['livre'][Book::TITRE]); ?>"/>
        <br/>
        <label for="nombre_page">
            Nombre de page:
        </label>
        <br/>
        <input type="text" name="nombre_page" id="nombre_page" size="10"
               value="<?php echo ($view['data']['livre'][Book::PAGES]); ?>"/>
        <br/>
        <label for="date_parution">
            Date de parution:
        </label>
        <br/>
        <select name="date_parution" id="date_parution">
            <?php for ($year = 1901; $year < 2155; $year++): ?>
            <option <?php if ($year == $view['data']['livre'][Book::DATE_PARUTION]): ?>
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
            <?php foreach (Book::getAllGenres() as $genre): ?>
            <option <?php if ($view['data']['livre'][Book::GENRE] == $genre): ?>
                selected="selected"<?php endif; ?> ><?php echo $genre ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="zone">
            Zone :
        </label>
        <br/>
        <select name="code_zone" id="zone">
            <?php foreach ($view['data']['zones'] as $zone): ?>
            <option <?php if ($view['data']['livre'][Book::ZONE] == $zone[Zone::CODE_ZONE]): ?>selected="selected"<?php endif;?>
                value="<?php echo $zone[Zone::CODE_ZONE]; ?>"><?php echo $zone[Zone::PIECE] . ' - ' . $zone[Zone::MEUBLE]; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label for="auteur">
            Auteur :
        </label>
        <br/>
        <select name="id_auteur" id="auteur">
            <?php foreach ($view['data']['auteurs'] as $auteur): ?>
            <option <?php if ($view['data']['auteur'][Author::ID_AUTEUR] == $auteur[Author::ID_AUTEUR]): ?>selected="selected"<?php endif;?>
                value="<?php echo $auteur[Author::ID_AUTEUR]; ?>"><?php echo $auteur[Author::NOM] . ' ' . $auteur[Author::PRENOM]; ?></option>
            <?php endforeach; ?>
        </select>
        <br/>

        <label for="fichier">
            Ajouter une image
        </label>
        <br/>
        <?php if (isset($view['data']['livre'][Book::IMAGE])): ?><img
        src="./vues/img/<?php echo $view['data']['livre'][Book::IMAGE] ?>" alt="image"/><?php endif; ?>
        <br/>
        <input type="file" name="fichier" id="fichier"/>


        <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
        <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
        <input type="hidden" name="isbn" value="<?php echo $view['data']['livre'][Book::ISBN] ?>"/>
        <input type="hidden" name="image" value="<?php echo $view['data']['livre'][Book::IMAGE] ?>"/>
        <input type="hidden" name="id_auteur2" value="<?php echo $view['data']['auteur'][Author::ID_AUTEUR] ?>"/>

        <div class="bouton">
            <input type="submit" value="Modifier"/>
        </div>
    </fieldset>
    </form>
        <?php else: ?>
    <p>Vous devez vous connecter pour modifier un livre.</p>
    <?php endif; ?>
</div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p class="retour"><a href="<?php echo Url::voirLivre($view['data']['livre'][Book::ISBN]); ?>">Retour à la fiche du
        livre</a></p>
    <?php else: ?>
    <p class="retour"><a href="<?php echo Url::connexionMembre(); ?>">Se connecter</a></p>
    <?php endif; ?>
</div>

