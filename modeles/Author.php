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
    const IMAGE = ':image';
    const ECRIT = 'ecrit';
    const ISBN = 'isbn';

    //Apple au __construct pour être sûr qu'il y a une connection PDO
    function __construct()
    {
        parent::__construct();
    }


    /**
     * Récupère toutes les données sur l'auteur triées par ordre alpha
     * @return array
     */
    public function getAll()
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
        $req = 'SELECT a.* FROM ' . self::TABLE . ' AS a JOIN ' . self::ECRIT . ' AS e ON e.' . self::ID_AUTEUR . ' WHERE e.' . self::ISBN . '=:isbn';
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
    public function deleteAuthor($id_auteur)
    {
        $req = 'DELET FROM ' . self::TABLE . ' WHERE ' . self::ID_AUTEUR . '=:id_auteur';
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
    public function updateAuthor(array $data)
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
    public function addAuthor(array $data)
    {
        $req = 'INSERT INTO ' . self::TABLE . ' VALUE (null, :nom, :prenom, :date_naissance, :image)';
        $param = Array(
            ':nom'           => $data[self::NOM],
            ':prenom'        => $data[self::PRENOM],
            ':date_naissance'=> $data[self::DATE_NAISSANCE],
            ':image'         => $data[self::IMAGE]
        );

        return $this->execute($req, $param);
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
            ':id_auteur' => self::ID_AUTEUR
        );
        $result = $this->fetch($req, $param);

        return $result['nb_id_auteur']; //Retourn 1 ou 0
    }
}
