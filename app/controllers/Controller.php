<?php
namespace App\Controllers;
use App\Models\UserModel;

class Controller {

    public function listUsers() {
        $users = UserModel::getUsers();
        if(!is_array($users)) {
            $error = $users;
        }
        require("../app/views/listUsers.php");
    }

    public function listDoctors() {
        echo "page liste des médecins";
    }
}