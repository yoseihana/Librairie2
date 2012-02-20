<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <ul>
            <li>
                <h2>Titre </h2>
                <p><?php echo ($view['data']['livre']['titre']); ?> </p>
            </li>
            <li>
                <h2>Date de parution </h2>
                <p><?php echo ($view['data']['livre']['date_parution']); ?></p>
            </li>
            <li>
                <h2>Nombre de page </h2>
                <p><?php echo ($view['data']['livre']['nombre_page']); ?></p>
            </li>
            <li>
                <h2>Genre</h2>
                <p><?php echo ($view['data']['livre']['genre']); ?></p>
            </li>
        </ul>
    </fieldset
</form>
</body>
<!-- Le $data ne s'affiche pas! -->
