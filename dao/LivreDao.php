<?php

class LivreDao extends AbstractDao
{

    public function __construct(PDO $dbConnection)
    {
        parent::__construct($dbConnection);
    }

    public function getAll()
    {
        // récupère une liste de livre
        $req = 'SELECT titre, isbn FROM livre ORDER BY titre';

        try
        {
            $res = $this->getConnex()->query($req); // récupération ds la BD, renvoi un résultat défini par la class PDO_STATEMENT = résultat
            //Fetch pr récupérer un tuple (=ligne) et le transformer ds le FETCH_MOD dtm
            $livres = $res->fetchAll(); //ds $livres il va y avoir un tableau de tableau associatif ac comme clef les noms des tables (isbn, nb_page...)
        }
        catch (PDOException $e)
        {
            die($e->getMessage()); // intéressant en phase développement lorsqu'on a une application, on fait une page qui reprend les erreurs
            // header(Location: index.php?c=error&a=e_database');
        }

        return $livres;
    }

    function findBooksByIsbn($isbn)
    { // récupère un livre
        global $connex;

        //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée
        $req = 'SELECT * FROM livre WHERE isbn = :isbn';

        try
        {
            $ps = $connex->prepare($req); // prépare la requete
            $ps->bindValue(':isbn', $isbn); // Lier l'isbn, si utilisation isbn au lieu du ?, on change 0 en 'isbn', mais ici garantie de ne pas avoir de problème d'injection sql
            $ps->execute(); // execution

            $livre = $ps->fetch(); // récupère un résultat, 1 seul livre
        }
        catch (PDOException $e)
        { // si il y a un problème, une exception
            die($e->getMessage());
            //header ('Location: index.php?c=erreor&a=e_database');
        }

        return $livre;
    }

    function findBooksByAuthor($id_auteur)
    {
        global $connex;

        $req = 'SELECT l.* FROM livre AS l JOIN ecrit AS e ON l.isbn = e.isbn WHERE e.id_auteur = :id_auteur';

        try
        {
            $ps = $connex->prepare($req);
            $ps->bindValue(':id_auteur', $id_auteur);
            $ps->execute();

            $livre = $ps->fetch();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
        return $livre;
    }

    function findBooksByZone($code_zone)
    {
        global $connex;

        $req = 'SELECT l.*  FROM livre AS l WHERE l.code_zone = :code_zone';

        try
        {
            $ps = $connex->prepare($req);
            $ps->bindValue(':code_zone', $code_zone);
            $ps->execute();

            $zone = $ps->fetch();

        } catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $zone;
    }

    function deleteBook($isbn)
    {
        global $connex;

        $req = 'DELETE FROM livre WHERE isbn = :isbn';

        try
        {
            $ps = $connex->prepare($req);

            $ps->bindValue(':isbn', $isbn);

            $ps->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return true;
    }

    function updateBook($data, $name)
    {

        global $connex;

        $req1 = 'UPDATE livre SET titre = :titre, nombre_page = :nombre_page, date_parution = :date_parution, genre = :genre, image = :image WHERE isbn = :isbn';
        $req2 = 'UPDATE ecrit SET id_auteur = :id_auteur WHERE isbn = :isbn';

        try
        {
            $connex->beginTransaction();

            $ps = $connex->prepare($req1);
            $ps->bindValue(':isbn', $data['livre']['isbn']);
            $ps->bindValue(':titre', $data['livre']['titre']);
            $ps->bindValue(':nombre_page', $data['livre']['nombre_page']);
            $ps->bindValue(':date_parution', $data['livre']['date_parution']);
            $ps->bindValue(':genre', $data['livre']['genre']);
            $ps->bindValue(':image', $name);
            $ps->execute();

            $ps = $connex->prepare($req2);
            $ps->bindValue(':isbn', $data['livre']['isbn']);
            $ps->bindValue(':id_auteur', $data['auteur']['id_auteur']);
            $ps->execute();

            $connex->commit();
        }
        catch (PDOException $e)
        {
            $connex->rollBack();
            die($e->getMessage());
            //header('Location: index.php?c=error&a=e_database');
        }

        return true;
    }

    function addBook($champs)
    {
        global $connex;

        //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée
        $req1 = 'INSERT INTO livre VALUES (:isbn, :titre, :date_parution, :nombre_page, :code_zone, :genre, :image);';
        $req2 = 'INSERT INTO ecrit VALUES (:isbn, :id_auteur)';
        try
        {
            $connex->beginTransaction();

            $ps = $connex->prepare($req1);
            $ps->bindValue(':isbn', $champs['isbn']);
            $ps->bindValue(':titre', $champs['titre']);
            $ps->bindValue(':nombre_page', $champs['nombre_page']);
            $ps->bindValue(':date_parution', $champs['date_parution']);
            $ps->bindValue(':code_zone', $champs['code_zone']);
            $ps->bindValue(':genre', $champs['genre']);
            $ps->bindValue(':image', $champs['image']);
            $ps->execute();

            $ps = $connex->prepare($req2);
            $ps->bindValue(':isbn', $champs['isbn']);
            $ps->bindValue(':id_auteur', $champs['id_auteur']);
            $ps->execute();

            $connex->commit();
        }
        catch (PDOException $e)
        {
            $connex->rollBack();
            die($e->getMessage());
            //header('Location: index.php?c=error&a=e_database');
        }

        return true;
    }

//récupérer le dernier id via pdo. Avec la valeur, s'en servire pr afficher la fiche de la zone et l'auteur

    function countBookByIsbn($isbn)
    {
        global $connex;

        $req = 'SELECT count(isbn) AS nb_isbn FROM livre WHERE isbn = :isbn';

        try
        {
            $ps = $connex->prepare($req);
            $ps->bindValue(':isbn', $isbn);
            $ps->execute();
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
            //header ('Location: index.php?c=error&a=e_database');
        }

        $nbIsbn = $ps->fetch();

        return $nbIsbn['nb_isbn']; // retourne 0 ou 1
    }


}