<h1>
    <?php echo $c; ?>
</h1>
<?php if (count($view['data']['auteurs']) > 0): ?>
<ul>
    <?php foreach ($view['data']['auteurs'] as $auteur): ?> <!-- Conmpte si il y a au moins 1 livre -->
    <li>
        <h2><a href="<?php echo voirAuteurUrl($auteur['id_auteur']); ?>"><?php echo $auteur['nom'] . ' ' . $auteur['prenom']; ?></a></h2>
        <br/>
        <?php if ($connected): ?>
        <a href="<?php echo modifierAuteurUrl($auteur['id_auteur']); ?>">Modifier</a> -
        <a href="<?php echo supprimerAuteurUrl($auteur['id_auteur']); ?>">Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>

<div class="ajouter">
    <?php if ($connected): ?> <p><a href="<?php echo ajouterAuteurUrl(); ?>">Ajouter un auteur</a></p><?php endif; ?>
</div>

<?php endif; ?>      