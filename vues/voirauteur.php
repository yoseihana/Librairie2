<h1>
    <?php echo $c; ?>
</h1>
<?php if (count($view['data'] ['auteurs'])): ?>
<ul>
    <?php foreach ($view['data']['auteurs'] as $auteur): ?> <!-- Conmpte si il y a au moins 1 livre -->
    <li>
        <h2><a
            href="<?php echo voirAuteurUrl($auteur['id_auteur']); ?>"><?php echo $auteur['nom'] . ' ' . $auteur['prenom']; ?></a>
        </h2>
        <br/>
        <?php if ($connected): ?>
        <a href="<?php echo modifierAuteurUrl($auteur['id_auteur']); ?>">Modifier</a>
        -
        <a href="<?php echo supprimerAuteurUrl($auteur['id_auteur']); ?>">Supprimer</a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
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

    <p><?php echo ($view['data']['auteur']['livre'] != null) ? $view['data']['auteur']['livre']['titre'] : 'Il n\'y a pas de livre pour cet auteur'; ?></p>
    <img src="./img/<?php echo $view['data']['auteur']['image'] ?>" alt="image"/>
</div>
<div class="ajouter">
<p><?php if ($connected): ?> <p><a
    href="<?php echo ajouterAuteurUrl($auteur['id_auteur']); ?>">Ajouter
    un auteur</a></p><?php endif; ?></p>
</div>