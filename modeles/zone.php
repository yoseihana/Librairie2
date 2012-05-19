<?php

class ZoneModel extends AbstractModel
{
    function __construct(PDO $dbConnection)
    {
        parent::__construct($dbConnection);
    }

    function getAllZones()
    {
        $req = 'SELECT * FROM zone ORDER BY piece';

        try {

            $res = $connex->query($req);
            $zones = $res->fetchAll();
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

        return $zones;
    }

    function findZoneByCode($code_zone)
    {
        global $connex;

        $req = 'SELECT * FROM zone WHERE code_zone = :code_zone';
        try {
            $ps = $connex->prepare($req);
            $ps->bindValue(':code_zone', $code_zone);
            $ps->execute();

            $zone = $ps->fetch();
        }
        catch (PDOException $e) {
            die($e->getMessage());
            //header ('Location: index.php?c=erreor&a=e_database');
        }

        return $zone;
    }

    function deleteZone($code_zone)
    {
        global $connex;

        $req = 'DELETE FROM zone WHERE code_zone = :code_zone';

        try {
            $ps = $connex->prepare($req);
            $ps->bindValue(':code_zone', $code_zone);
            $ps->execute();
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

        return true;
    }

    function updateZone($data)
    {

        global $connex;

        $req = 'UPDATE zone SET piece = :piece, meuble = :meuble WHERE code_zone = :code_zone';

        try {
            $ps = $connex->prepare($req);

            $ps->bindValue(':code_zone', $data['zone']['code_zone']);
            $ps->bindValue(':piece', $data['zone']['piece']);
            $ps->bindValue(':meuble', $data['zone']['meuble']);

            $ps->execute();
        }
        catch (PDOException $e) {
            die($e->getMessage());
            //header('Location: index.php?c=error&a=e_database');
        }

        return true;
    }

    function addZone()
    {
        global $connex;

        $req = 'INSERT INTO zone VALUES (:code_zone, :piece, :meuble);'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée

        try {
            $ps = $connex->prepare($req);

            $ps->bindValue(':code_zone', $_POST['code_zone']);
            $ps->bindValue(':piece', $_POST['piece']);
            $ps->bindValue(':meuble', $_POST['meuble']);
            $ps->execute();

        }
        catch (PDOException $e) {
            die($e->getMessage());
            //header('Location: index.php?c=error&a=e_database');
        }
    }

    function countZoneByCode($code_zone)
    {
        global $connex;
        $req = 'SELECT count(code_zone) AS nb_code_zone FROM zone WHERE code_zone = :code_zone';

        try {
            $ps = $connex->prepare($req);
            $ps->bindValue(':code_zone', $code_zone);
            $ps->execute(); // execution
        }
        catch (PDOException $e) {
            die($e->getMessage());
            //header ('Location: index.php?c=error&a=e_database');
        }

        $nbCodeZone = $ps->fetch();
        $nbCodeZone = $nbCodeZone['nb_code_zone'];

        return $nbCodeZone['nb_code_zone'];
    }
}