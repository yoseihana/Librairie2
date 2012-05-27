<h1><?php echo $view['data']['view_title'];?></h1>
<?php if (count($view['data']['livres']) > 0): ?>
<ul>
    <?php foreach ($view['data']['livres'] as $livre): ?>
    <li>
        <h2><a href="<?php echo Url::voirLivre($livre[Book::ISBN]); ?>"><?php echo $livre[Book::TITRE]; ?></a></h2>
        <?php if ($connected): ?>
        <br/>
        <a href="<?php echo Url::modifierLivre($livre[Book::ISBN]); ?>"> Modifier</a>
        -
        <a href="<?php echo Url::supprimerLivre($livre[Book::ISBN]); ?>"> Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
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

    <img src="./img/<?php echo $view['data']['livre'][Book::IMAGE] ?>" alt="image"/>
</div>
<div class="ajouter">
    <?php if ($connected): ?>
    <p><a href="<?php echo Url::ajouterLivre(); ?>">Ajouter un livre</a></p>
    <?php endif; ?>
</div>
