<?php

function getMemberCount($data)
{
    global $connex;
    
    $req = 'SELECT count(id_membre) AS nb_membre FROM membre WHERE email = :email AND mdp = :mdp';
    
    try
    {
        $ps = $connex->prepare($req);
        $ps->bindValue(':email', $data['email']);
        $ps->bindValue(':mdp', $data['mdp']);
        $ps->execute();
    }
    catch (PDOException $e)
    {
        die($e->getMessage());
        //header ('Location: index.php?c=error&a=e_database');
    }
    
    $nbMembre = $ps->fetch();
    return $nbMembre['nb_membre'];
}