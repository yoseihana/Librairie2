<h1>
    <?php echo $view['data']['view_title']; ?>
</h1>
<div class="voir">
    <h3>
        Nom
    </h3>

    <p><?php echo($view['data']['auteur']['nom']); ?> </p>

    <h3>
        Prénom
    </h3>

    <p><?php echo($view['data']['auteur']['prenom']); ?> </p>

    <h3>
        Date de naissance
    </h3>

    <p><?php echo($view['data']['auteur']['date_naissance']); ?></p>

    <h3>
        Livre(s) de cet auteur
    </h3>
    <ul>
        <?php if ($view['data']['livres'] != null): ?>
        <?php foreach ($view['data']['livres'] as $auteurs): ?>
            <li class="auteurLivre"><?php echo $auteurs[Book::TITRE] ?></li>
            <?php endforeach; ?>
        <?php else: ?>
        <p>
            Il n'y a pas de livre pour cet auteur
        </p>
        <?php endif; ?>
    </ul>
    <img src="./img/<?php echo $view['data']['auteur']['image'] ?>" alt="image"/>
</div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p><a href="<?php echo Url::modifierAuteur($view['data']['auteur'][Author::ID_AUTEUR]); ?>">Modifier de l'auteur</a>
    </p>
    <p><a href="<?php echo Url::supprimerAuteur($view['data']['auteur'][Author::ID_AUTEUR]); ?>">Supprimer l'auteur</a>
    </p>
    <p><a href="<?php echo Url::ajouterAuteur(); ?>">Ajouter un auteur</a></p>
    <?php endif; ?>
    <p class="retour"><a href="<?php echo Url::listerAuteur(); ?>">Retour à liste des auteurs</a></p>
</div>