<div class="voir">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <label from="email">
                Email:
            </label>
            <br/>
            <input type="text" name="email" id="email"/>
            <br/>
            <label from="mdp">
                Mot de passe:
            </label>
            <br/>
            <input type="password" name="mdp" id="mdp"/>
            <br/>

            <div class="bouton">
                <input type="submit" value="Verifier"/>
            </div>
        </fieldset>

        <input type="hidden" name="a" value="<?php echo $validActions['connecter'] ?>"/>
        <input type="hidden" name="c" value="<?php echo $validControllers['membre'] ?>"/>

    </form>
</div>