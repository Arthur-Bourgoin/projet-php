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
        $doctors = DoctorModel::getDoctors();
        $users = UserModel::getUsers();
        $idDoctor = isset($_SESSION["rdv"]["doctor"]) ? $_SESSION["rdv"]["doctor"] : 0;
        $idUser = isset($_SESSION["rdv"]["user"]) ? $_SESSION["rdv"]["user"] : 0;
        $rdvs = RdvModel::getRdvs($idDoctor, $idUser);
        unset($_SESSION["rdv"]);
        require("../app/views/rdv.php");
    }

    public function filterTable() {
        $_SESSION["rdv"]["doctor"] = $_POST["doctor"] ? $_POST["doctor"] : 0;
        $_SESSION["rdv"]["user"] = $_POST["user"] ? $_POST["user"] : 0;
    }

    public function addRdv() {
        if(!$this->verifRdv())
            Feedback::setError("Ajout impossible, les informations sont invalides.");
        elseif(RdvModel::isOverlapRdvDoctor($_POST))
            Feedback::setError("Ajout impossible, les consultations du médecin se chevauchent.");
        elseif(RdvModel::isOverlapRdvUser($_POST))
            Feedback::setError("Ajout impossible, les consultations de l'usager se chevauchent.");
        else
            RdvModel::addRdv($_POST);
    }

    public function updateRdv() {
        if(!$this->verifRdv() || empty($_POST["idRdv"]))
            Feedback::setError("Mise à jour impossible, les informations sont invalides.");
            elseif(RdvModel::isOverlapRdvDoctor($_POST))
            Feedback::setError("Ajout impossible, les consultations du médecin se chevauchent.");
        elseif(RdvModel::isOverlapRdvUser($_POST))
            Feedback::setError("Ajout impossible, les consultations de l'usager se chevauchent.");
        else
            RdvModel::updateRdv($_POST);
    }

    public function deleteRdv() {
        if(empty($_POST["idRdv"]))
            Feedback::setError("Impossible de supprimer cette consultation.");
        else
            RdvModel::deleteRdv($_POST["idRdv"]);
    }

    public function verifRdv() {
        return !empty($_POST["idDoctor"]) && !empty(["idUser"]) && !empty(["dateTime"]) && !empty(["duration"]);
    }

}