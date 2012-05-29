<?php

final class DB
{

    // Constantes pour configuration
    const DRIVER = 'pdo_driver';
    const HOST = 'db_host';
    const NAME = 'db_name';
    const USER = 'db_user';
    const PASSWORD = 'db_password';

    private static $pdo;

    // a = 5 b =& a  -> b pointe vers la même zone mémoire donc valeur que a même si a change de valeur
    // http://be.php.net/manual/fr/language.references.whatdo.php
    public static function &getPdoInstance()
    {

        // On passe par une variable locale (via référence) pour accèder à la variable statique
        // juste pour "préciser" le type de la veleur retour. Ici PDO;
        // Comme c'est une référence, on a pas besoin de faire l'assignation inverse.
        $conn =& self::$pdo;
        // self:: pour acceder à des constantes dans la class

        if ($conn)
        {
            return $conn;
        }

        try
        {
            //Element défini dans config.php
            $dsn = constant(self::DRIVER) . ':host=' . constant(self::HOST) . ';dbname=' . constant(self::NAME);
            $conn = new PDO($dsn, constant(self::USER), constant(self::PASSWORD),
                array(
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            );

            $conn->query('SET CHARACTER SET UTF8');
            $conn->query('SET NAMES UTF8');

        } catch (PDOException $e)
        {
            die($e->getMessage());
        }

        return $conn;
    }
}
