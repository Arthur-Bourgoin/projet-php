<?php
namespace App\Controllers;
use App\Models\ {
    RdvModel,
    DoctorModel,
    UserModel
};
use App\Class\Feedback;

class RdvController {

    public function displayPage() {
        $rdvs = RdvModel::getRdvs();
        $doctors = DoctorModel::getDoctors();
        $users = UserModel::getUsers();
        $idDoctor = isset($_SESSION["rdv"]["doctor"]) ? $_SESSION["rdv"]["doctor"] : 0;
        $idUser = isset($_SESSION["rdv"]["user"]) ? $_SESSION["rdv"]["user"] : 0;
        require("../app/views/rdv.php");
    }

    public function filterTable() {
        $_SESSION["rdv"]["doctor"] = $_POST["doctor"] ? $_POST["doctor"] : 0;
        $_SESSION["rdv"]["user"] = $_POST["user"] ? $_POST["user"] : 0;
    }

    public function addRdv() {
        if(!$this->verifRdv()) {
            Feedback::setError("Ajout impossible, les données sont invalides.");
        } else {
            $rdvs = RdvModel::getRdvsByDoctor($_POST["idDoctor"]);
        }
    }

    public function verifRdv() {
        return !empty($_POST["idDoctor"]) && !empty(["idUser"]) && !empty(["dateTime"]) && !empty(["duration"]);
    }

}