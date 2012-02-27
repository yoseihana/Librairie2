<h1>
    <?php echo $c; ?>
</h1>
<?php if (count($view['data']['auteurs'])): ?>
    <ul>
        <?php foreach ($view['data']['auteurs'] as $auteur): ?> <!-- Conmpte si il y a au moins 1 livre -->
            <li>
                <h2><a href="?c=<?php echo $GLOBALS['validEntities']['auteur']; ?>&a=<?php echo $GLOBALS['validActions']['voir']; ?>&id_auteur=<?php echo($auteur['id_auteur']); ?>"><?php echo $auteur['nom'] . ' ' . $auteur['prenom']; ?></a> </h2>
                <br/>
                <?php if ($connected): ?>
                    <a href="?c=<?php echo $GLOBALS['validEntities']['auteur']; ?>&a=<?php echo $GLOBALS['validActions']['modifier']; ?>&id_auteur=<?php echo($auteur['id_auteur']); ?>">Modifier</a> -
                    <a href="?c=<?php echo $GLOBALS['validEntities']['auteur']; ?>&a=<?php echo $GLOBALS['validActions']['supprimer']; ?>&id_auteur=<?php echo($auteur['id_auteur']); ?>">Supprimer</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

        <div class="ajouter">
<?php if($connected): ?> <p> <a href="?c=<?php echo $GLOBALS['validEntities']['auteur']; ?>&a=<?php echo $GLOBALS['validActions']['ajouter']; ?>">Ajouter un auteur</a></p><?php endif; ?>
        </div>

<?php endif; ?>      