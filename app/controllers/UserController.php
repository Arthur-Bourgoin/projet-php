<?php
namespace App\Controllers;
use App\Models\ {
    UserModel,
    DoctorModel
};

/*
ERRORS:
0: OK
1: error init list user
2: error update user, datas not valid
3: error update user, error PDO query
4: error delete user

*/

class UserController {

    public function listUsers() {
        $this->displayTemplate(0, 0);
    }

    public function addUser() {

    }

    public function updateUser() {
        $error = 0;
        if(!$this->verifUpdateUser()) {
            $error = 2;
        } else {
            $_POST["civility"] = $_POST["civility"] === "Mr." ? "M" : "F";
            if(!UserModel::updateUser($_POST))
                $error = 3;
        }
        $this->displayTemplate($error, $error===0 ? 1 : 0);
    }

    public function deleteUser() {
        $error = 0;
        if(!UserModel::deleteUser($_POST["idUser"]))
            $error = 4;
        $this->displayTemplate($error, $error===0 ? 2 : 0);
    }

    private function displayTemplate(int $p_error, int $p_success) {
        $error = $p_error;
        $success = $p_success;
        $users = UserModel::getUsers();
        $doctors = DoctorModel::getDoctors();
        if(!is_array($users) || !is_array($doctors)) 
            $error = 1;
        require("../app/views/listUsers.php");
    }

    private function verifUpdateUser() {
        if(
            !isset($_POST["idUser"]) ||
            !isset($_POST["civility"]) ||
            !isset($_POST["lastName"]) ||
            !isset($_POST["firstName"]) ||
            !isset($_POST["birthDate"]) ||
            !isset($_POST["birthPlace"]) ||
            !isset($_POST["secuNumber"]) ||
            !isset($_POST["postalCode"]) ||
            !isset($_POST["city"]) ||
            !isset($_POST["address"]) ||
            !isset($_POST["idDoctor"])
        )
            return false;
        if($_POST["civility"]!=="Mr." && $_POST["civility"]!=="Mme.")
            return false;
        if(!ctype_digit($_POST["secuNumber"]) || strlen($_POST["secuNumber"])!==15)
            return false;
        if(!ctype_digit($_POST["postalCode"]) || strlen($_POST["postalCode"])!==5)
            return false;
        // Error on id doctor   
        return true;     
    }

}