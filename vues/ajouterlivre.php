<h1><?php echo $c . ' a ' . $a; ?></h1>
<form action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
    <fieldset>
        <label for="titre">
            Titre:
        </label>
        <br/>
        <input type="text" name="titre" value="Titre"/>
        <br/>
        <label for="isbn">
            ISBN:
        </label>
        <br/>
        <input type="text" name="isbn" value="123-4567-8901-2"/>
        <br/>
        <label for="date">
            Date de parution:
        </label>
        </br>
        <input type="text" name="date_parution" value="YYYY"/>
        <br/>
        <label for="nombre">
            Nombre de page:
        </label>
        <br/>
        <input type="text" name="nombre_page" value="1234"/>
        <br/>
        <label for="code_zone">
            Code zone:
        </label>
        <br/>
        <input type="text" name="code_zone" value="s1"/>
        <br/>
        <label for="genre">
            Genre:
        </label>
        <br/>
        <select name="genre" id="genre">
            <option value="roman">
                Roman
            </option>
            <option value="policier">
                Policier
            </option>
            <option value="historique">
                Historique
            </option>
            <option value="théâtre">
                Théâtre
            </option>
            <option value="fantastique">
                Fantastique
            </option>

        </select>
        <input type="hidden" name="c" value="<?php echo ($validEntities['livre']); ?>"/>
        <input type="hidden" name="a" value="<?php echo ($validActions['ajouter']); ?>"/>

        <div class="bouton">
            <input type="submit" value="Ajouter"/>
        </div>
    </fieldset>
</form>

<!-- Souci dans l'ajout on ne fait pas avec l'isbn -->