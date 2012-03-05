<?php if ($connected) : ?>
<h1><?php echo $c . ' a ' . $a; ?></h1>
<?php if (isset($view['data']['erreur'])): ?><h1><?php echo $view['data']['erreur']; ?></h1><?php endif; ?>
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="code_zone">
            Code Zone
        </label>
        <input type="text" name="code_zone" value="<?php echo isset($view['data']['zone']['code_zone']) ? $view['data']['zone']['code_zone'] : 's1'; ?>"/>
        <label for="piece">
            Piece
        </label>
        <input type="text" name="piece" value="<?php echo isset($view['data']['zone']['piece']) ? $view['data']['zone']['piece'] : 'Salon'; ?>"/>
        <label for="meuble">
            Meuble
        </label>
        <input type="text" name="meuble" value="<?php echo isset($view['data']['zone']['meuble']) ? $view['data']['zone']['meuble'] : 'commode jaune'; ?>"/>


        <input type="hidden" name="c" value="<?php echo ($validControllers['zone']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['ajouter']); ?>"/>
        <input type="submit" value="ajouter"/>
    </fieldset>
</form>
<?php else: ?>
<p>Vous devez vous connecter pour acceder à cette page </p>
<?php endif; ?>