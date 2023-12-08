<?php
namespace App\Models;
use Config\Database;
use App\Class\User;

class UserModel {

    public static function getUsers() {
        try {
            $users = [];
            $res = Database::getInstance()->query("SELECT * FROM usager");
            while ($data = $res->fetch()) {
                $users[] = new User($data);
            }
            return $users;
        } catch(\Exception $e) {
            return 0;
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

}