<?php
namespace App\Controllers;
use App\Models\DoctorModel;
use App\Class\ {
    Feedback,
    UploadImg
};

class DoctorController {

    public function listDoctors() {
        $doctors = DoctorModel::getDoctors();
        require("../app/views/listDoctors.php");
    }

    public function addDoctor() {
        if(!$this->verifDoctor() || $_FILES["picture"]["error"] === UPLOAD_ERR_NO_FILE) {
            Feedback::setError("Impossible d'ajouter le médecin, les données entrées sont invalides.");
        } else {
            $upload = new UploadImg($_FILES["picture"]);
            if($upload->upload("./assets/images/users/")) {
                $_POST["picture"] = $upload->getUniqName();
                DoctorModel::addDoctor($_POST);
            }
        }
    }

    public function updateDoctor() {
        if(!$this->verifDoctor() || empty($_POST["idDoctor"])) {
            Feedback::setError("Mise à jour impossible, les données ne sont pas valides.");
        } else {
            DoctorModel::updateDoctor($_POST);
        }
    }

    public function updateDoctor2() {
        if(!$this->verifDoctor() || empty($_POST["idDoctor"])) {
            Feedback::setError("Mise à jour impossible, les données ne sont pas valides.");
        } else {
            if($_FILES["picture"]["error"] === UPLOAD_ERR_NO_FILE) {
                $_POST["picture"] = "";
                DoctorModel::updateDoctor($_POST);
            } else {
                $doctor = DoctorModel::getDoctor($_POST["idDoctor"]);
                unlink("." . $doctor->picture);
                $upload = new UploadImg($_FILES["picture"]);
                if($upload->upload("./assets/images/users/")) {
                    $_POST["picture"] = $upload->getUniqName();
                    DoctorModel::addDoctor($_POST);
                }
            }
        }
    }
    
    public function deleteDoctor() {
        if(empty($_POST["idDoctor"])) {
            Feedback::setError("Impossible de supprimer le médecin.");
        } else {
            $doctor = DoctorModel::getDoctor($_POST["idDoctor"]);
            if(!empty($doctor)) {
                unlink("." . $doctor->picture);
                DoctorModel::deleteDoctor($_POST["idDoctor"]);
            }
        }
    }

    private function verifDoctor() {
        if(empty($_POST["civility"]) || empty($_POST["lastName"]) || empty($_POST["firstName"]) || !isset($_FILES["picture"]))
            return false;
        return $_POST["civility"] === "M" || $_POST["civility"] === "F";
    }

    

}