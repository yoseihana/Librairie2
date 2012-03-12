<h1>
    <?php echo $c;?>
</h1>
<?php if (count($view['data']['livres']) > 0): ?>
<ul>
    <?php foreach ($view['data']['livres'] as $livre): ?>
    <li>
        <h2><a href="<?php echo voirLivreUrl($livre['isbn']); ?>"><?php echo $livre['titre']; ?></a></h2>
        <?php if ($connected): ?>
        <br/>
        <a href="<?php echo modifierLivreUrl($livre['isbn']); ?>"> Modifier</a>
        -
        <a href="<?php echo supprimerLivreUrl($livre['isbn']); ?>"> Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<div class="voir">
    <h3>
        Titre
    </h3>

    <p class="first"><?php echo($view['data']['livre']['titre']); ?></p>

    <h3>
        Nombre de pages
    </h3>

    <p><?php echo($view['data']['livre']['nombre_page']); ?> </p>

    <h3>
        Année de parution
    </h3>

    <p><?php echo($view['data']['livre']['date_parution']); ?></p>

    <h3>
        Genre
    </h3>

    <p><?php echo($view['data']['livre']['genre']); ?></p>

    <h3>
        Nom et prénom
    </h3>

    <p><?php echo ($view['data']['livre']['auteur'] != null) ? $view['data']['livre']['auteur']['nom'] . ' ' . $view['data']['livre']['auteur']['prenom'] : 'Il n\'y a pas d\'auteur enregistré pour ce livre'; ?></p>

    <img src="./img/<?php echo $view['data']['livre']['image'] ?>" alt="image"/>
</div>
<div class="ajouter">
    <?php if ($connected): ?>
    <p><a href="<?php echo ajouterLivreUrl(); ?>">Ajouter un livre</a></p>
    <?php endif; ?>
</div>
