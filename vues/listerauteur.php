<h1>
    <?php echo $view['data']['view_title']; ?>
</h1>
    <div class="voir">
<?php if (count($view['data']['auteurs']) > 0): ?>
    <ul>
        <?php foreach ($view['data']['auteurs'] as $auteur): ?> <!-- Conmpte si il y a au moins 1 livre -->
        <li>
            <h2><a
                href="<?php echo Url::voirAuteur($auteur['id_auteur']); ?>"><?php echo $auteur[Author::PRENOM] . ' ' . $auteur[Author::NOM]; ?></a>
            </h2>
            <br/>
            <?php if (MainController::isAuthenticated()): ?>
            <a href="<?php echo Url::modifierAuteur($auteur['id_auteur']); ?>">Modifier</a> -
            <a href="<?php echo Url::supprimerAuteur($auteur['id_auteur']); ?>">Supprimer</a>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
 </div>
<div class="ajouter">
    <?php if (MainController::isAuthenticated()): ?>
    <p class="retour"><a href="<?php echo Url::ajouterAuteur(); ?>">Ajouter un auteur</a></p>
    <?php else: ?>
    <p class="retour"><a href="<?php echo Url::connexionMembre(); ?>">Se connecter</a></p>
    <?php endif; ?>
</div>

<?php endif; ?>
<div class="pagination">
    <?php for ($i = 1; $i <= $view['data']['nbPage']; $i++): ?>
    <a href="index.php?a=lister&c=auteur&page=<?php echo $i ?>"><?php echo $i ?></a>
    <?php endfor; ?>
</div>