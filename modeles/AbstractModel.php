<?php

require_once './config/DB.php';

abstract class AbstractModel
{
    protected $connection;

    function __construct()
    {
        $this->connection =& DB::getPdoInstance();
    }

    /**
     * Cette fonction pépare et exécute un PDOStatement
     * @param string $request - La requête SQL
     * @param array|null $parameters  - Les paramètres de la requête SQL [optional]
     * @return bool
     */
    protected final function execute($request, array $parameters = NULL)
    {
        try
        {
            $statement = $this->connection->prepare($request);
            return $statement->execute($parameters);
        } catch (PDOException $e)
        {
            $this->_PDOExceptionHandling($e);
        }
    }

    /**
     * Cette fonction pépare, exécute et collecte tout les résultats d'un PDOStatement
     * @param string $request - La requête SQL
     * @param array $parameters - Les paramètres de la requête SQL [optional]
     * @return array
     */
    protected final function fetchAll($request, array $parameters = NULL)
    {
        try
        {
            $statement = $this->connection->prepare($request);
            $statement->execute($parameters);

            return $statement->fetchAll();
        } catch (PDOException $e)
        {
            $this->_PDOExceptionHandling($e);
        }
    }

    /**
     * Cette fonction pépare, exécute et collecte un seul résultat d'un PDOStatement
     * @param string $request - La requête SQL
     * @param array $parameters - Les paramètres de la requête SQL [optional]
     * @return mixed
     */
    protected final function fetch($request, array $parameters = NULL)
    {
        try
        {
            $statement = $this->connection->prepare($request);
            $statement->execute($parameters);

            return $statement->fetch();
        } catch (PDOException $e)
        {
            $this->_PDOExceptionHandling($e);
        }
    }

    /**
     * Cette méthode privée gère la manière dont une PDOException doit être traitée.
     * Le but de cette méthode est du refactoring pure
     * @param PDOException $e
     */
    private function _PDOExceptionHandling(PDOException $e)
    {
        // D'abord on annule la transaction, s'il y a.
        if ($this->connection->inTransaction())
        {
            $this->connection->rollBack();
        }
        die($e->getMessage());
    }
}
