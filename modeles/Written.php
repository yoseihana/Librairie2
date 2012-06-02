<?php

require_once 'AbstractModel.php';

final class Written extends AbstractModel
{
    const TABLE = 'ecrit';
    const AUTHOR_ID = 'id_auteur';
    const ISBN = 'isbn';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Supprime une relation livre-auteur
     * @param $data
     * @return bool
     */
    public function delete($data)
    {
        $req = 'DELETE FROM ' . self::TABLE
            . ' WHERE ' . self::ISBN . ' = :isbn'
            . ' AND ' . self::AUTHOR_ID . ' = :id_auteur';

        $param = array(
            ':isbn'      => $data[self::ISBN],
            ':id_auteur' => $data[self::AUTHOR_ID]
        );

        return $this->execute($req, $param);
    }

    /**
     * Supprime toutes les relations d'auteurs d'un livre
     * @param $isbn
     * @return bool
     */
    public function deleteAllByIsbn($isbn)
    {
        $req = 'DELETE FROM ' . self::TABLE
            . ' WHERE ' . self::ISBN . ' = :isbn';

        $param = array(
            ':isbn' => $isbn,
        );

        return $this->execute($req, $param);
    }

    /**
     * Ajoute une relation livre-auteur
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $req = 'INSERT INTO ' . self::TABLE . ' VALUES (:isbn, :id_auteur)';

        $param = array(
            ':isbn'      => $data[self::ISBN],
            ':id_auteur' => $data[self::AUTHOR_ID]
        );

        return $this->execute($req, $param);
    }
}
