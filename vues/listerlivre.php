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
        <a href="<?php echo modifierLivreUrl($livre['isbn']); ?>">Modifier</a>
        -
        <a href="<?php echo supprimerLivreUrl($livre['isbn']); ?>">Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<div class="ajouter">
    <?php if ($connected): ?>
    <p><a href="<?php echo ajouterLivreUrl(); ?>">Ajouter un livre</a></p>
    <?php endif; ?>
</div>