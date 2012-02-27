<?php


function getList() {
    global $connex;

    $req = 'SELECT *
                        FROM zone
                        ORDER BY piece';

    try {

        $res = $connex->query($req); 
        $zones = $res->fetchAll();
    }
    catch (PDOException $e) {
        die($e->getMessage()); 
    }

    return $zones;
}

function getOne($code_zone) {
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

function delete($code_zone) {
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

function update($data) {

    global $connex;

    $req = 'UPDATE zone SET piece = :piece, meuble = :meuble WHERE code_zone = :code_zone';

    try {
        $ps = $connex->prepare($req);

        $ps->bindValue(':code_zone', $data['code_zone']);
        $ps->bindValue(':piece', $data['piece']);
        $ps->bindValue(':meuble', $data['meuble']);

        $ps->execute();
    }
    catch (PDOException $e) {
        die($e->getMessage());
        //header('Location: index.php?c=error&a=e_database');
    }

    return true;
}

function add() {

    
   if(!getCodeZoneCount($_POST['code_zone']))
    {
        global $connex;

    $req = 'INSERT INTO zone VALUES (:code_zone, :piece, :meuble);'; //on place soit le ? ou le nom de var qu'on veut ajouter. On peux tuilier aussi :isbn au lieu du ?. Ici avec : on prépare une requête et la donnée
   // $req2 = 'INSERT INTO ecrit VALUES (:isbn, :id_auteur)';
    
    
    try {
        $ps = $connex->prepare($req);

        $ps->bindValue(':code_zone', $_POST['code_zone']);
        $ps->bindValue(':piece', $_POST['piece']);
        $ps->bindValue(':meuble', $_POST['meuble']);
        $ps->execute();
        
        /*$ps = $connex->prepare($req2);
        $ps->bindValue(':isbn', $_POST['isbn']);
        $ps->bindValue(':id_auteur', $_POST['id_auteur']);
        $ps->execute();*/
    }
    catch (PDOException $e) {
        die($e->getMessage());
        //header('Location: index.php?c=error&a=e_database');
    }

    return true;
   }
    else {
        return false;
   }
}

function getCodeZoneCount($code_zone) {
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