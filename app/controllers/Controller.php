<?php
namespace App\Controllers;
use App\Models\UserModel;

class Controller {

    public function listUsers() {
        $users = UserModel::getUsers();
        var_dump($users);
        //require("../app/views/listUsers.php");
    }

    public function listDoctors() {
        echo "page liste des médecins";
    }
}