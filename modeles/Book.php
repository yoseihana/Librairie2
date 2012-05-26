<?php

require_once 'AbstractModel.php';

final class Book extends AbstractModel
{
    const TABLE = 'livre';
    const ISBN = 'isbn';
    const TITRE = 'titre';
    const DATE_PARUTION = 'date_parution';
    const PAGES = 'nombre_page';
    const ZONE = 'code_zone';
    const GENRE = 'genre';
    const IMAGE = 'image';

    private static $genres = array(
        'roman',
        'policier',
        'historique',
        'théâtre',
        'fantastique',
        'bd',
        'document'
    );

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupére tout les livres trié par titre en ordre alphabétique
     * @return array
     */
    public function getAll()
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' ORDER BY ' . self::TITRE;

        return $this->fetchAll($req);
    }

    /**
     * Récupère un livre avec son ISBN
     * @param $isbn
     * @return mixed
     */
    public function findByIsbn($isbn)
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' WHERE ' . self::ISBN . ' = :isbn';
        $param = array(
            ':isbn' => $isbn
        );

        return $this->fetch($req, $param);
    }

    /**
     * Récupère la liste des livres écrit par l'auteur
     * @param $id_auteur
     * @return array
     */
    public function findByAuthor($id_auteur)
    {
        $req = 'SELECT l.* '
            . 'FROM ' . self::TABLE . ' AS l '
            . 'JOIN ' . Written::TABLE . ' AS e '
            . 'ON l.' . self::ISBN . ' = e.' . Written::ISBN . ' '
            . 'WHERE e.' . Written::AUTHOR_ID . ' = :id_auteur';
        $param = array(
            ':id_auteur' => $id_auteur
        );

        return $this->fetchAll($req, $param);
    }

    /**
     * Récupère la liste des livres situé dans la zone définie
     * @param $code_zone
     * @return array
     */
    public function findByZone($code_zone)
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' WHERE ' . self::ZONE . ' = :code_zone';
        $param = array(
            ':code_zone' => $code_zone
        );

        return $this->fetchAll($req, $param);
    }

    /**
     * Supprime SEULEMENT le livre par son ISBN.
     * @param $isbn
     * @return bool
     */
    public function delete($isbn)
    {
        $req = 'DELETE FROM ' . self::TABLE . ' WHERE ' . self::ISBN . ' = :isbn';
        $param = array(
            ':isbn' => $isbn
        );

        return $this->execute($req, $param);
    }

    /**
     * Met à jour SEULEMENT le livre avec les valeurs contenues dans $data
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        $req = 'UPDATE ' . self::TABLE
            . ' SET ' . self::TITRE . ' = :titre, '
            . self::PAGES . ' = :nombre_page, '
            . self::DATE_PARUTION . ' = :date_parution, '
            . self::GENRE . ' = :genre, '
            . self::ZONE . ' = :zone, '
            . self::IMAGE . ' = :image '
            . 'WHERE ' . self::ISBN . ' = :isbn';

        $param = array(
            ':isbn'          => $data[self::ISBN],
            ':titre'         => $data[self::TITRE],
            ':nombre_page'   => $data[self::PAGES],
            ':date_parution' => $data[self::DATE_PARUTION],
            ':genre'         => $data[self::GENRE],
            ':zone'          => $data[self::ZONE],
            ':image'         => $data[self::IMAGE]
        );

        return $this->execute($req, $param);
    }

    /**
     * Ajoute SEULEMENT le livre avec les valeurs contenues dans $data (sauf l'ISBN)
     * @param array $data
     * @return bool
     */
    public function add(array $data)
    {
        $req = 'INSERT INTO ' . self::TABLE . ' VALUES (:isbn, :titre, :date_parution, :nombre_page, :zone, :genre, :image)';
        $param = array(
            ':isbn'          => $data[self::ISBN],
            ':titre'         => $data[self::TITRE],
            ':date_parution' => $data[self::DATE_PARUTION],
            ':nombre_page'   => $data[self::PAGES],
            ':zone'          => $data[self::ZONE],
            ':genre'         => $data[self::GENRE],
            ':image'         => $data[self::IMAGE]
        );

        return $this->execute($req, $param);
        // TODO : (idée) récupérer le nouvel ID et le retourner
    }

    /**
     * Retourne 1 si un livre avec l'ISBN fourni existe sinon 0
     * @param $isbn
     * @return mixed
     */
    public function countByIsbn($isbn)
    {
        $req = 'SELECT count(' . self::ISBN . ') AS nb_livre FROM ' . self::TABLE . ' WHERE ' . self::ISBN . ' = :isbn';

        $param = array(
            ':isbn' => $isbn
        );

        $result = $this->fetch($req, $param);

        return $result['nb_livre']; // retourne 0 ou 1
    }

    public static function getAllGenres()
    {
        sort(self::$genres, SORT_STRING);
        return self::$genres;
    }
}