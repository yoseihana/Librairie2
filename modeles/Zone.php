<?php

class Zone extends AbstractModel
{
    const TABLE = 'zone';
    const CODE_ZONE = 'code_zone';
    const PIECE = 'piece';
    const MEUBLE = 'meuble';


    function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourne tous les éléments des zones
     * @return array
     */
    function getAllZones()
    {
        $req = 'SELECT * FROM' . self::TABLE . ' ORDER BY ' . self::PIECE;

        return $this->fetchAll($req);
    }

    /**
     * Retourne les éléments selon le code_zone
     * @param $code_zone
     * @return mixed
     */
    function findZoneByCode($code_zone)
    {
        $req = 'SELECT * FROM ' . self::TABLE . ' WHERE ' . self::CODE_ZONE . ' = :code_zone';
        $param = Array(
            ':code_zone' => self::CODE_ZONE
        );
        return $this->fetchAll($req, $param);
    }

    /**
     * Suppression de la zone
     * @param $code_zone
     * @return bool
     */
    function deleteZone($code_zone)
    {
        $req = 'DELETE FROM ' . self::TABLE . ' WHERE ' . self::CODE_ZONE . '= :code_zone';
        $param = Array(
            ':code_zone' => self::CODE_ZONE
        );

        return $this->execute($req, $param);
    }

    /**
     * Mise à jour d'une zone
     * @param array $data
     * @return bool
     */
    function updateZone(array $data)
    {
        $req = 'UPDATE ' . self::TABLE . ' SET ' . self::PIECE . '= :piece,' . self::MEUBLE . '= :meuble WHERE ' . self::CODE_ZONE . '= :code_zone';
        $param = Array(
            ':piece'     => $data[self::PIECE],
            ':meuble'    => $data[self::MEUBLE],
            ':code_zone' => $data[self::CODE_ZONE]
        );
        return $this->execute($req, $param);

    }

    /**
     * Ajouter une zone
     * @param array $data
     * @return bool
     */
    function addZone(array $data)
    {
        $req = 'INSERT INTO ' . self::TABLE . ' VALUES (:code_zone, :piece, :meuble);'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée
        $param = Array(
            ':code_zone' => $data[self::CODE_ZONE],
            ':piece'     => $data[self::PIECE],
            ':meubme'    => $data[self::MEUBLE]
        );

        return $this->execute($req, $param);
    }

    /**
     * Compte si il existe déjà une élément avec ce code_zone. Retourne 1 si il existee t 0 si il n'existe pas
     * @param $code_zone
     * @return mixed
     */
    function countZoneByCode($code_zone)
    {
        $req = 'SELECT count(' . self::CODE_ZONE . ') AS nb_code_zone FROM ' . self::TABLE . ' WHERE ' . self::CODE_ZONE . '= :code_zone';
        $param = Array(
            ':code_zone' => self::CODE_ZONE
        );
        $result = $this->execute($req, $param);
        return $result['nb_code_zone']; //Retourne 0 ou 1
    }
}