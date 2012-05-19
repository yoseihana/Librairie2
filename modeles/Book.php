<?php

class Book extends AbstractModel
{
    const TABLE = 'livre';
    const ISBN = 'isbn';
    const TITLE = 'titre';
    const RELEASE_DATE = 'date_parution';
    const PAGES = 'nombre_page';
    const ZONE = 'code_zone';
    const GENRE = 'genre';
    const IMAGE = 'image'; //TODO Check column name

    /**
     * Récupére tout les livres trié par titre en ordre alphabétique
     * @return array
     */
    public static function getAll()
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' ORDER BY ' . self::TITLE;

        return self::fetchAll($req);
    }

    /**
     * Récupère un livre avec son ISBN
     * @static
     * @param $isbn
     * @return mixed
     */
    public static function findByIsbn($isbn)
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' WHERE ' . self::ISBN . ' = :isbn';
        $param = array(
            ':isbn' => $isbn
        );

        return self::fetch($req, $param);
    }

    /**
     * Récupère la liste des livres écrit par l'auteur
     * @static
     * @param $id_auteur
     * @return array
     */
    public static function findByAuthor($id_auteur)
    {
        $req = 'SELECT l.* '
            . 'FROM ' . self::TABLE . ' AS l '
            . 'JOIN ' . Written::TABLE . ' AS e '
            . 'ON l.' . self::ISBN . ' = e.' . Written::ISBN . ' '
            . 'WHERE e.' . Written::AUTHOR_ID . ' = :id_auteur';
        $param = array(
            ':id_auteur' => $id_auteur
        );

        return self::fetchAll($req, $param);
    }

    /**
     * Récupère la liste des livres situé dans la zone définie
     * @static
     * @param $code_zone
     * @return array
     */
    public static function findByZone($code_zone)
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' WHERE ' . self::ZONE . ' = :code_zone';
        $param = array(
            ':code_zone' => $code_zone
        );

        return self::fetchAll($req, $param);
    }

    /**
     * Supprime SEULEMENT le livre par son ISBN.
     * @static
     * @param $isbn
     * @return bool
     */
    public static function delete($isbn)
    {
        $req = 'DELETE FROM ' . self::TABLE . ' WHERE ' . self::ISBN . ' = :isbn';
        $param = array(
            ':isbn' => $isbn
        );

        return self::execute($req, $param);
    }

    /**
     * Met à jour SEULEMENT le livre avec les valeurs contenues dans $data
     * @static
     * @param array $data
     * @return bool
     */
    public static function update(array $data)
    {
        $req = 'UPDATE ' . self::TABLE
            . ' SET ' . self::TITLE . ' = :titre, '
            . self::PAGES . ' = :nombre_page, '
            . self::RELEASE_DATE . ' = :date_parution, '
            . self::GENRE . ' = :genre, '
            . self::ZONE . ' = :zone, '
            . self::IMAGE . ' = :image '
            . 'WHERE ' . self::ISBN . ' = :isbn';

        $param = array(
            ':isbn' => $data[self::ISBN],
            ':titre' => $data[self::TITLE],
            ':nombre_page' => $data[self::PAGES],
            ':date_parution' => $data[self::RELEASE_DATE],
            ':genre' => $data[self::GENRE],
            ':zone' => $data[self::ZONE],
            ':image' => $data[self::IMAGE]
        );

        return self::execute($req, $param);
    }

    /**
     * Ajoute SEULEMENT le livre avec les valeurs contenues dans $data (sauf l'ISBN)
     * @static
     * @param array $data
     * @return bool
     */
    public static function add(array $data)
    {
        $req = 'INSERT INTO ' . self::TABLE . ' VALUES (:isbn, :titre, :date_parution, :nombre_page, :zone, :genre, :image)';
        $param = array(
            ':isbn' => $data[self::ISBN],
            ':titre' => $data[self::TITLE],
            ':date_parution' => $data[self::RELEASE_DATE],
            ':nombre_page' => $data[self::PAGES],
            ':zone' => $data[self::ZONE],
            ':genre' => $data[self::GENRE],
            ':image' => $data[self::IMAGE]
        );

        return self::execute($req, $param);
        // TODO : idée récupérer le nouvel ID et le retourner
    }

    /**
     * Retourne 1 si un livre avec l'ISBN fourni existe sinon 0
     * @static
     * @param $isbn
     * @return mixed
     */
    public static function countByIsbn($isbn)
    {
        $req = 'SELECT count(' . self::ISBN . ') AS nb_livre FROM ' . self::TABLE . ' WHERE ' . self::ISBN . ' = :isbn';

        $param = array(
            ':isbn' => $isbn
        );

        $result = self::fetch($req, $param);

        return $result['nb_livre']; // retourne 0 ou 1
    }

}