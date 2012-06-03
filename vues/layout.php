<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="fr-BE"
      lang="fr-BE">

<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type"
          content="text/css"/>
    <meta http-equiv="Content-Language"
          content="fr"/>

    <title>
        Bibliothèque - <?php echo $view['data']['view_title']; ?>
    </title>

    <link rel="stylesheet"
          type="text/css"
          href="./vues/screen.css"
          media="screen"
          title="Normal"/>
</head>
<body>
<div class="header">
    <div class="connection">
        <?php if (!MainController::isAuthenticated()): ?>
        <p>
            Vous n'êtes pas connecté - <a href="<?php echo Url::connexionMembre(); ?>">Connexion</a>
        </p>
        <?php else: ?>
        <p>
            Vous êtes connecté - <a href="<?php echo Url::deconnexionMembre(); ?>">Deconnexion</a>
        </p>
        <?php endif; ?>
    </div>
    <div class="menu">
        <ol>
            <li>
                <a href="<?php echo Url::listerLivre() ?>" title="Lister les livres">Livres</a>
            </li>
            <li>
                <a href="<?php echo Url::listerAuteur() ?>" title="Lister les auteurs">Auteurs</a>
            </li>
            <li>
                <a href="<?php echo Url::listerZone() ?>" title="Lister les zones">Zones</a>
            </li>
        </ol>
    </div>

</div>
<div id="title">
    <p><a href="index.php" title="Retour à la page accueil" all="Retour à la page accueil">Gestion de bibliothèque de
        l'INPRES</a></p>
</div>
<div class="content">
    <?php include($view['html']); ?>
</div>

</body>
</html>