<?php

function getAllAuthors()
{
    global $connex;

    $req = 'SELECT nom, prenom, id_auteur FROM auteur ORDER BY nom ASC';


    try
    {
        $res = $connex->query($req);
        $auteur = $res->fetchAll();
    }
    catch (PDOException $e)
    {
        die($e->getMessage());
    }
    return $auteur;
}

function findAuthorById($id_auteur)
{
    global $connex;

    $req = 'SELECT * FROM auteur WHERE id_auteur = :id_auteur';

    try
    {
        $ps = $connex->prepare($req);
        $ps->bindValue(':id_auteur', $id_auteur);
        $ps->execute();

        $auteur = $ps->fetch();
    }
    catch (PDOException $e)
    {
        die($e->getMessage());
    }
    return $auteur;

}

function findAuthorByBook($isbn)
{
    global $connex;

    $req = 'SELECT a.* FROM auteur AS a JOIN ecrit AS e ON a.id_auteur = e.id_auteur WHERE e.isbn = :isbn';

    try
    {
        $ps = $connex->prepare($req);
        $ps->bindValue(':isbn', $isbn);
        $ps->execute();

        $auteur = $ps->fetch();
    }
    catch (PDOException $e)
    {
        die($e->getMessage());
    }
    return $auteur;
}

function deleteAuthor($data)
{

    global $connex;
    $req = 'DELETE FROM auteur WHERE id_auteur = :id_auteur';

    try
    {
        $ps = $connex->prepare($req);
        $ps->bindValue(':id_auteur', $data['id_auteur']);
        $ps->execute();


    }
    catch (PDOException $e)
    {
        die($e->getMessage());
    }

    return true;
}

function updateAuthor($data)
{

    global $connex;

    $req = 'UPDATE auteur SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE id_auteur = :id_auteur';

    try
    {
        $ps = $connex->prepare($req);

        $ps->bindValue(':id_auteur', $data['id_auteur']);
        $ps->bindValue(':nom', $data['nom']);
        $ps->bindValue(':prenom', $data['prenom']);
        $ps->bindValue(':date_naissance', $data['date_naissance']);

        $ps->execute();
    }
    catch (PDOException $e)
    {
        die($e->getMessage());
        //header('Location: index.php?c=error&a=e_database');
    }

    return true;
}

function addAuthor($author)
{
    if (!getidAuteurCount($author['id_auteur']))
    {
        global $connex;

        $req = 'INSERT INTO auteur VALUES (:id_auteur, :nom, :prenom, :date_naissance);';
        // $req2 = 'INSERT INTO ecrit VALUES (:isbn, :id_auteur)';

        try
        {
            $ps = $connex->prepare($req);

            $ps->bindValue(':id_auteur', $author['id_auteur']);
            $ps->bindValue(':nom', $author['nom']);
            $ps->bindValue(':prenom', $author['prenom']);
            $ps->bindValue(':date_naissance', $author['date_naissance']);
            $ps->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
            //header('Location: index.php?c=error&a=e_database');
        }

        return true;
    }
    else
    {
        return false;
    }
}

function countAuthorByIdautor($id_auteur)
{
    global $connex; // récupérer la connection
    $req = 'SELECT count(id_auteur) AS nb_id_auteur FROM auteur WHERE id_auteur = :id_auteur'; // récupère le nbre d'isbn

    try
    {
        $ps = $connex->prepare($req); // connection
        $ps->bindValue(':id_auteur', $id_auteur); //les valeurs sont liées
        $ps->execute(); // execution
    }
    catch (PDOException $e)
    {
        die($e->getMessage());
        //header ('Location: index.php?c=error&a=e_database');
    }

    $nbidAuteur = $ps->fetch();
    //$nbidAuteur = $nbidAuteur['nb_id_auteur']; // extraction du nbre de ISBN trouver

    return $nbidAuteur['nb_id_auteur']; // retourne 0 ou 1
}
