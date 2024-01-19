<?php
namespace app\controllers;
use app\models\DoctorModel;
use app\class\ {
    Feedback,
    UploadImg
};

class DoctorController {

    private $upload;

    public function __construct(?UploadImg $upload) {
        $this->upload = empty($upload) ? new UploadImg() : $upload;
    }

    public function listDoctors() {
        $doctors = DoctorModel::getDoctors();
        require("../app/views/listDoctors.php");
    }

    public function addDoctor() {
        if(!$this->verifDoctor() || empty($_FILES["picture"]["name"])) {
            Feedback::setError("Impossible d'ajouter le médecin, les données entrées sont invalides.");
        } else {
            if($this->upload->upload($_FILES["picture"], "./assets/images/users/")) {
                $_POST["picture"] = $this->upload->getUniqName();
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
    
    public function deleteDoctor() {
        if(empty($_POST["idDoctor"])) {
            Feedback::setError("Impossible de supprimer le médecin.");
        } else {
            $doctor = DoctorModel::getDoctor($_POST["idDoctor"]);
            if(!empty($doctor)) {
                DoctorModel::deleteDoctor($_POST["idDoctor"]);
                unlink("." . $doctor->picture);
            }
        }
    }

    private function verifDoctor() {
        if(empty($_POST["civility"]) || empty($_POST["lastName"]) || empty($_POST["firstName"]))
            return false;
        return $_POST["civility"] === "M" || $_POST["civility"] === "F";
    }

    

}