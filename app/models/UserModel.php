<?php
namespace App\Models;
use Config\Database;

class UserModel {

    public static function getUsers() {
        $res = Database::getInstance()->query("SELECT * FROM usager");
        $tab = $res->fetchAll();
        $res->closeCursor();
        return $tab;
    }

}