<h1><?php echo $view['data']['view_title'] ?></h1>
<div class="voir">
    <?php if (MainController::isAuthenticated()): ?>
    <form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="nom">
                Nom:
            </label>
            <br/>
            <input type="text" name="nom" value="Nom" id="nom"/>
            <br/>
            <label for="prenom">
                Prénom:
            </label>
            <br/>
            <input type="text" name="prenom" value="Prénom" id="prenom"/>
            <br/>
            <label for="date_naissance">
                Date de naissance:
            </label>
            <br/>
            <input type="text" name="date_naissance" value="YYYY/MM/JJ" id="date_naissance"/>
            <br/>
            <label for="fichier">
                Ajouter une image
            </label>
            <br/>
            <input type="file" name="fichier" id="fichier">


            <input type="hidden" name="image" value="<?php echo $view['data']['auteur']['image'] ?>"/>

            <div class="bouton">
                <input type="submit" value="Ajouter"/>
            </div>

            <input type="hidden" name="c" value="<?php echo MainController::getLastController() ?>"/>
            <input type="hidden" name="a" value="<?php echo MainController::getLastAction() ?>"/>
            <input type="hidden" name="image" value="<?php echo $view['data']['auteur'][Author::IMAGE] ?>"/>
        </fieldset>
    </form>
    <?php else: ?>
    <p>Vous devez vous connecter pour ajouter un auteur.</p>
    <?php endif; ?>
</div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p class="retour"><a href="<?php echo Url::listerAuteur(); ?>">Retour à liste des auteur.</a></p>
    <?php else: ?>
    <p class="retour"><a href="<?php echo Url::connexionMembre(); ?>">Se connecter</a></p>
    <?php endif; ?>
</div>