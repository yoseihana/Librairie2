<?php
/**
 * Created by JetBrains PhpStorm.
 * User: annabelle
 * Date: 3/06/12
 * Time: 17:14
 * To change this template use File | Settings | File Templates.
 */
require_once 'AbstractModel.php';
final class Membre extends AbstractModel
{
    const TABLE = 'membre';
    const ID = 'id_membre';
    const MAIL = 'email';
    const NOM = 'nom';
    const PRENOM = 'prenom';
    const PASSWORD = 'mdp';

    function __construct()
    {
        parent::__construct();
    }

    public function authentication(array $data)
    {
        $req = 'SELECT count(' . self::ID . ') as auth FROM ' . self::TABLE . ' WHERE ' . self::MAIL . ' = :email AND ' . self::PASSWORD . ' = :mdp';
        $param = array(
            ':email' => $data[self::MAIL],
            ':mdp'   => sha1($data[self::PASSWORD])
        );

        $result = $this->fetch($req, $param);
        return $result['auth'] == 1;
    }
}
