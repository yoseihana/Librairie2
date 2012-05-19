<?php

require_once './config/DB.php';

abstract class AbstractModel
{
    /**
     * Obtenir par référence l'instance de la connexion PDO (unique)
     * @static
     * @return PDO
     */
    protected static function &getConnection()
    {
        return DB::getPdoInstance();
    }

    /**
     * Cette fonction pépare et exécute un PDOStatement
     * @param string $request - La requête SQL
     * @param array $parameters - Les paramètres de la requête SQL [optional]
     */
    protected static function execute($request, array $parameters = NULL)
    {
        try {
            $statement = self::getConnection()->prepare($request);
            return $statement->execute($parameters);
        } catch (PDOException $e) {
            self::_PDOExceptionHandling($e);
        }
    }

    /**
     * Cette fonction pépare, exécute et collecte tout les résultats d'un PDOStatement
     * @param string $request - La requête SQL
     * @param array $parameters - Les paramètres de la requête SQL [optional]
     */
    protected static function fetchAll($request, array $parameters = NULL)
    {
        try {
            $statement = self::getConnection()->prepare($request);
            $statement->execute($parameters);

            return $statement->fetchAll();
        } catch (PDOException $e) {
            self::_PDOExceptionHandling($e);
        }
    }

    /**
     * Cette fonction pépare, exécute et collecte un seul résultat d'un PDOStatement
     * @param string $request - La requête SQL
     * @param array $parameters - Les paramètres de la requête SQL [optional]
     */
    protected static function fetch($request, array $parameters = NULL)
    {
        try {
            $statement = self::getConnection()->prepare($request);
            $statement->execute($parameters);

            return $statement->fetch();
        } catch (PDOException $e) {
            self::_PDOExceptionHandling($e);
        }
    }

    /**
     * Cette méthode privée gère la manière dont une PDOException doit être traitée.
     * Le but de cette méthode est du refactoring pure
     * @param PDOException $e
     */
    private static function _PDOExceptionHandling(PDOException $e)
    {
        // D'abord on annule la transaction, s'il y a.
        if (self::getConnection()->inTransaction()) {
            self::getConnection()->rollBack();
        }
        die($e->getMessage());
    }
}
