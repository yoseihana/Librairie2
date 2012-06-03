<?php
/**
 * Created by JetBrains PhpStorm.
 * User: annabelle
 * Date: 19/05/12
 * Time: 08:58
 * To change this template use File | Settings | File Templates.
 */
class Author extends AbstractModel
{
    const TABLE = 'auteur';
    const NOM = 'nom';
    const PRENOM = 'prenom';
    const ID_AUTEUR = 'id_auteur';
    const DATE_NAISSANCE = 'date_naissance';
    const IMAGE = 'image';

    //Apple au __construct pour être sûr qu'il y a une connection PDO
    function __construct()
    {
        parent::__construct();
    }


    /**
     * Récupère toutes les données sur l'auteur triées par ordre alpha
     * @return array
     */
    public function getAll($premiereEntree)
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' ORDER BY ' . self::NOM . ' ASC LIMIT ' . $premiereEntree . ', 5';

        return $this->fetchAll($req);
    }

    public function getAllAuthor()
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' ORDER BY ' . self::NOM;

        return $this->fetchAll($req);
    }

    /**
     * Récupère les données sur auteur selon son id_auteur
     * @param $id_auteur
     */
    public function findById($id_auteur)
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' WHERE ' . self::ID_AUTEUR . '=:id_auteur';
        $param = Array(
            ':id_auteur' => $id_auteur
        );

        return $this->fetch($req, $param);
    }

    /**
     * Récupère les données selon un livre
     * @param $isbn
     * @return mixed
     */
    public function findByBook($isbn)
    {
        $req = 'SELECT a.* FROM ' . self::TABLE . ' AS a JOIN ' . Written::TABLE . ' AS e ON a.' . self::ID_AUTEUR . ' = e.' . Written::AUTHOR_ID . ' WHERE e.' . Written::ISBN . '=:isbn';
        $param = Array(
            ':isbn' => $isbn
        );
        return $this->fetch($req, $param);
    }

    /**
     * Suppression d'un auteur
     * @param $id_auteur
     * @return bool
     */
    public function delete($id_auteur)
    {
        $req = 'DELETE FROM ' . self::TABLE . ' WHERE ' . self::ID_AUTEUR . '=:id_auteur';
        $param = Array(
            ':id_auteur' => $id_auteur
        );
        return $this->execute($req, $param);
    }

    /**
     * Mise à jour des éléments auteur
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        $req = 'UPDATE ' . self::TABLE . ' SET ' . self::NOM . '=:nom, ' . self::PRENOM . '=:prenom, ' . self::DATE_NAISSANCE . '=:date_naissance, ' . self::IMAGE . '=:image WHERE ' . self::ID_AUTEUR . '=:id_auteur';
        $param = Array(
            ':id_auteur'      => $data[self::ID_AUTEUR],
            ':nom'            => $data[self::NOM],
            ':prenom'         => $data[self::PRENOM],
            ':date_naissance' => $data[self::DATE_NAISSANCE],
            ':image'          => $data[self::IMAGE]
        );
        return $this->execute($req, $param);
    }

    /**
     * Ajouter un auteur
     * @param array $data
     * @return bool
     */
    public function add(array $data)
    {
        $req = 'INSERT INTO ' . self::TABLE . ' VALUE (null, :nom, :prenom, :date_naissance, :image)';
        $param = Array(
            ':nom'           => $data[self::NOM],
            ':prenom'        => $data[self::PRENOM],
            ':date_naissance'=> $data[self::DATE_NAISSANCE],
            ':image'         => $data[self::IMAGE]
        );

        $this->execute($req, $param);
        return $this->connection->lastInsertId();
    }

    /**
     * Retourn 1 si un livre existe déjà avec l'id et 0 si il n'existe pas
     * @param $id_auteur
     * @return mixed
     */
    public function countAuthorById($id_auteur)
    {
        $req = 'SELECT count(' . self::ID_AUTEUR . ') as nb_id_auteur FROM ' . self::TABLE . ' WHERE ' . self::ID_AUTEUR . '=:id_auteur';
        $param = Array(
            ':id_auteur' => $id_auteur
        );
        $result = $this->fetch($req, $param);

        return $result['nb_id_auteur']; //Retourn 1 ou 0
    }

    public function countAuthor()
    {
        $req = 'SELECT count(*) AS totale FROM ' . self::TABLE;
        $totaleAuteur = $this->fetch($req);
        return $totaleAuteur;
    }
}
