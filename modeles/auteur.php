<?php

function getList()
{
    global $connex;

    //$req = 'SELECT * FROM auteur ORDER BY nom ASC';
    $req = 'SELECT livre.*, ecrit.*, auteur.*, zone.* FROM livre LEFT JOIN ecrit ON livre.isbn = ecrit.isbn LEFT JOIN auteur ON ecrit.id_auteur = auteur.id_auteur LEFT JOIN zone ON livre.code_zone = zone.code_zone WHERE livre.isbn = :isbn';

    try {
        $res = $connex->query($req);
        $auteur = $res->fetchAll();
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
    return $auteur;
}

function getOne($id_auteur)
{
    global $connex;

    $req = 'SELECT * FROM auteur WHERE id_auteur = :id_auteur';

    try {
        $ps = $connex->prepare($req);

        $ps->bindValue(':id_auteur', $id_auteur);
        $ps->execute();

        $auteur = $ps->fetch();
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
    return $auteur;

}

function delete($data)
{

    global $connex;
    $req = 'DELETE FROM auteur WHERE id_auteur = :id_auteur';

    try {
        $ps = $connex->prepare($req);
        $ps->bindValue(':id_auteur', $data['id_auteur']);
        $ps->execute();


    }
    catch (PDOException $e) {
        die($e->getMessage());
    }

    return true;
}

function update($data)
{

    global $connex;

    $req = 'UPDATE auteur SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE id_auteur = :id_auteur';

    try {
        $ps = $connex->prepare($req);

        $ps->bindValue(':id_auteur', $data['id_auteur']);
        $ps->bindValue(':nom', $data['nom']);
        $ps->bindValue(':prenom', $data['prenom']);

        /* if(':date_naissance' !== '0000-00-00')
        {*/
        $ps->bindValue(':date_naissance', $data['date_naissance']);

        /* }*/


        $ps->execute();
    }
    catch (PDOException $e) {
        die($e->getMessage());
        //header('Location: index.php?c=error&a=e_database');
    }

    return true;
}

// Ajouter fct getAuthorsForBook. Utilisation de jointure, pr lier les 2 tables. Fair idem dans le blog. Utilisation de jointure

function add()
{


    if (!getidAuteurCount($_POST['id_auteur'])) {
        global $connex;

        $req = 'INSERT INTO auteur VALUES (:id_auteur, :nom, :prenom, :date_naissance);';
        // $req2 = 'INSERT INTO ecrit VALUES (:isbn, :id_auteur)';


        try {
            $ps = $connex->prepare($req);

            $ps->bindValue(':id_auteur', $_POST['id_auteur']);
            $ps->bindValue(':nom', $_POST['nom']);
            $ps->bindValue(':prenom', $_POST['prenom']);
            $ps->bindValue(':date_naissance', $_POST['date_naissance']);
            $ps->execute();

            /*$ps = $connex->prepare($req2);
            $ps->bindValue(':isbn', $_POST['isbn']);
            $ps->bindValue(':id_auteur', $_POST['id_auteur']);
            $ps->execute();*/
        }
        catch (PDOException $e) {
            die($e->getMessage());
            //header('Location: index.php?c=error&a=e_database');
        }

        return true;
    }
    else {
        return false;
    }
}

function getidAuteurCount($id_auteur)
{
    global $connex; // récupérer la connection
    $req = 'SELECT count(id_auteur) AS nb_id_auteur FROM auteur WHERE id_auteur = :id_auteur'; // récupère le nbre d'isbn

    try {
        $ps = $connex->prepare($req); // connection
        $ps->bindValue(':id_auteur', $id_auteur); //les valeurs sont liées
        $ps->execute(); // execution
    }
    catch (PDOException $e) {
        die($e->getMessage());
        //header ('Location: index.php?c=error&a=e_database');
    }

    $nbidAuteur = $ps->fetch();
    $nbidAuteur = $nbidAuteur['nb_id_auteur']; // extraction du nbre de ISBN trouver

    return $nbidAuteur['nb_id_auteur']; // retourne 0 ou 1
}

function getAuthorsForBook($author)
{
    global $connex;
    $req = 'SELECT livre.*, ecrit.*, auteur.*, zone.* FROM livre LEFT JOIN ecrit ON livre.isbn = ecrit.isbn LEFT JOIN auteur ON ecrit.id_auteur = auteur.id_auteur LEFT JOIN zone ON livre.code_zone = zone.code_zone WHERE livre.isbn = :isbn'; // jointure exetrne

    try {
        $ps = $connex->prepare($req);

        $ps->bindValue(':isbn', $data['isbn']);

        $ps->execute();
    }
    catch (PDOException $e) {
        die($e->getMessage());
        //header('Location: index.php?c=error&a=e_database');
    }

    return true;
}
