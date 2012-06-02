<?php if (true)
{
    ?>
<h1><?php echo $view['data']['view_title']; ?></h1>
<div class="voir">
    <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="nom">
                Nom:
            </label>
            <br/>
            <input type="text" name="nom" id="nom" value="<?php echo ($view['data']['auteur'][Author::NOM]); ?>"/>
            <br/>
            <label for="prenom">
                Prénom:
            </label>
            <br/>
            <input type="text" name="prenom" id="prenom"
                   value="<?php echo ($view['data']['auteur'][Author::PRENOM]); ?>"/>
            <br/>
            <label for="date_naissance">
                Date de naissance:
            </label>
            <br/>
            <input type="text" name="date_naissance" id="date_naissance"
                   value="<?php echo ($view['data']['auteur'][Author::DATE_NAISSANCE]); ?>"/>
            <br/>

            <label for="fichier">
                Ajouter une image
            </label>
            <br/>
            <img src="./img/<?php echo $view['data']['auteur']['image'] ?>" alt="image"/>
            <br/>
            <input type="file" name="fichier" id="fichier"/>

            <input type="hidden" name="id_auteur" value="<?php echo ($view['data']['auteur']['id_auteur']); ?>"/>
            <input type="hidden" name="image" value="<?php echo $view['data']['auteur']['image'] ?>"/>

            <div class="bouton">
                <input type="submit" value="Modifier"/>
            </div>

            <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
            <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
            <input type="hidden" name="id_auteur" value="<?php echo $view['data']['auteur'][Author::ID_AUTEUR] ?>"/>
            <input type="hidden" name="image" value="<?php echo $view['data']['auteur'][Author::IMAGE] ?>"/>
            <input type="hidden" name="isbn2" value="<?php echo $view['data']['auteur'][Book::ISBN] ?>"/>
        </fieldset>
    </form>
</div>
<div class="ajouter">
    <?php if (true): ?>
    <p class="retour"><a href="<?php echo Url::voirAuteur($view['data']['auteur'][Author::ID_AUTEUR]); ?>">Retour à la
        fiche de l'auteur</a></p>
    <?php endif; ?>
</div>
<?php
}
else
{
    echo '<p>Vous devez vous connecter pour acceder à cette page </p>';
} ?>