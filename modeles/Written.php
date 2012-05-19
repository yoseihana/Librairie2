<?php

class Written extends AbstractModel
{
    const TABLE = 'ecrit';
    const AUTHOR_ID = 'id_auteur';
    const ISBN = 'isbn';

    /**
     * Supprime une relation livre-auteur
     * @static
     * @param $data
     * @return bool
     */
    public static function delete($data)
    {
        $req = 'DELETE FROM ' . self::TABLE
            . ' WHERE ' . self::ISBN . ' = :isbn'
            . ' AND ' . self::AUTHOR_ID . ' = :old_id_auteur';

        $param = array(
            ':isbn' => $data[self::ISBN],
            ':id_auteur' => $data[self::AUTHOR_ID]
        );

        return self::execute($req, $param);
    }

    /**
     * Ajoute une relation livre-auteur
     * @static
     * @param $data
     * @return bool
     */
    public static function add($data)
    {
        $req = 'INSERT INTO ' . self::TABLE . 'VALUES (:isbn, :id_auteur)';

        $param = array(
            ':isbn' => $data[self::ISBN],
            ':id_auteur' => $data[self::AUTHOR_ID]
        );

        return self::execute($req, $param);
    }
}
