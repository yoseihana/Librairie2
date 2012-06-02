<h1><?php echo $view['data']['view_title']?></h1>
<div class="voir">
    <?php if (count($view['data']['livres']) > 0): ?>
    <ul>
        <?php foreach ($view['data']['livres'] as $livre): ?>
        <li>
            <h2><a href="<?php echo Url::voirLivre($livre[Book::ISBN]); ?>"><?php echo $livre[Book::TITRE]; ?></a></h2>
            <?php if (true): ?>
            <a href="<?php echo Url::modifierLivre($livre[Book::ISBN]); ?>">Modifier</a>
            -
            <a href="<?php echo Url::supprimerLivre($livre[Book::ISBN]); ?>">Supprimer</a>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<div class="ajouter">
    <?php if (true): ?>
    <p><a href="<?php echo Url::ajouterLivre(); ?>">Ajouter un livre</a></p>
    <?php endif; ?>
</div>
<div class="pagination">
    <?php for ($i = 1; $i <= $view['data']['nbPage']; $i++): ?>
    <a href="index.php?a=lister&c=livre&page=<?php echo $i ?>"><?php echo $i ?></a>
    <?php endfor; ?>
</div>