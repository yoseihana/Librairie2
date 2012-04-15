<?php

abstract class AbstractDao
{
    private $connection;

    protected function __construct($connction)
    {

    }

    private function setConnection($connection)
    {
        $this->connection = $connection;
    }

    protected function getConnection()
    {
        return $this->connection;
    }

}
