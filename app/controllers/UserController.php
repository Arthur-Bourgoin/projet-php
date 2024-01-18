<?php
namespace App\Controllers;
use App\Models\ {
    UserModel,
    DoctorModel
};
use App\Class\ {
    Feedback,
    UploadImg
};

class UserController {

    private $upload;

    public function __construct(?UploadImg $upload) {
        $this->upload = empty($upload) ? new UploadImg() : $upload;
    }

    public function listUsers() {
        $users = UserModel::getUsers();
        $doctors = DoctorModel::getDoctors();
        require("../app/views/listUsers.php");
    }

    public function addUser() {
        if(!$this->verifUser() || empty($_FILES["picture"]["name"])) {
            Feedback::setError("Les informations de l'utilisateur ne sont pas valides.");
        } else {
            if($this->upload->upload($_FILES["picture"], "./assets/images/users/")) {
                $_POST["picture"] = $this->upload->getUniqName();
                UserModel::addUser($_POST);
            }
        }
    }

    public function updateUser() {
        if(!$this->verifUser() || empty($_POST["idUser"])) {
            Feedback::setError("Erreur, les informations de l'usager ne sont pas valides.");
        } else {
            $_POST["civility"] = $_POST["civility"] === "Mr." ? "M" : "F";
            UserModel::updateUser($_POST);
        }
    }

    public function deleteUser() {
        if(empty($_POST["idUser"])) {
            Feedback::setError("Erreur, aucun utilisateur à supprimer.");
        } else {
            $user = UserModel::getUser($_POST["idUser"]);
            if(!empty($user)) {
                UserModel::deleteUser($_POST["idUser"]);
                unlink("." . $user->picture);
            }
        }
    }

    private function verifUser() {
        if(
            empty($_POST["civility"]) ||
            empty($_POST["lastName"]) ||
            empty($_POST["firstName"]) ||
            empty($_POST["birthDate"]) ||
            empty($_POST["birthPlace"]) ||
            empty($_POST["secuNumber"]) ||
            empty($_POST["postalCode"]) ||
            empty($_POST["city"]) ||
            empty($_POST["address"]) ||
            !isset($_POST["idDoctor"])
        )
            return false;
        if($_POST["civility"]!=="Mr." && $_POST["civility"]!=="Mme." && $_POST["civility"]!=="M" && $_POST["civility"]!=="F")
            return false;
        if(!ctype_digit($_POST["secuNumber"]) || strlen($_POST["secuNumber"])!==15)
            return false;
        if(!ctype_digit($_POST["postalCode"]) || strlen($_POST["postalCode"])!==5)
            return false;
        // Error on id doctor   
        return true;     
    }

}