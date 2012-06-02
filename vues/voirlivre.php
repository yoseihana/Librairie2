<h1><?php echo $view['data']['view_title'];?></h1>
<div class="voir">
    <h3>
        Titre
    </h3>

    <p class="first"><?php echo($view['data']['livre'][Book::TITRE]); ?></p>

    <h3>
        Nombre de pages
    </h3>

    <p><?php echo($view['data']['livre'][Book::PAGES]); ?> </p>

    <h3>
        Année de parution
    </h3>

    <p><?php echo($view['data']['livre'][Book::DATE_PARUTION]); ?></p>

    <h3>
        Genre
    </h3>

    <p><?php echo($view['data']['livre'][Book::GENRE]); ?></p>

    <h3>
        Nom et prénom
    </h3>

    <p><?php echo ($view['data']['auteur'] != null) ? $view['data']['auteur'][Author::NOM] . ' ' . $view['data']['auteur'][Author::PRENOM] : 'Il n\'y a pas d\'auteur enregistré pour ce livre'; ?></p>
     <h3>
         Zone de rangement
     </h3>
    <p>Pièce: <?php echo($view['data']['zone'][Zone::PIECE]); ?> - Meuble: <?php echo($view['data']['zone'][Zone::MEUBLE]); ?></p>
    <img src="./img/<?php echo $view['data']['livre'][Book::IMAGE] ?>" alt="image"/>
</div>
<div class="ajouter">
    <?php if (true): ?>
    <p><a href="<?php echo Url::modifierLivre($view['data']['livre'][Book::ISBN]); ?>">Modifier le livre</a></p>
    <p><a href="<?php echo Url::supprimerLivre($view['data']['livre'][Book::ISBN]); ?>">Supprimer le livre</a></p>
    <p><a href="<?php echo Url::ajouterLivre(); ?>">Ajouter un livre</a></p>
    <p class="retour"><a href="<?php echo Url::listerLivre(); ?>">Retour à liste de livres</a></p>
    <?php endif; ?>
</div>
