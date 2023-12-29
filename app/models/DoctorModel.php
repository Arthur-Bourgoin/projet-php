<?php
namespace App\Models;
use Config\Database;
use App\Class\ {
    Doctor,
    Feedback
};

class DoctorModel {

    public static function getDoctors() {
        try {
            $doctors = [];
            $res = Database::getInstance()->query("SELECT * FROM medecin");
            while ($data = $res->fetch()) {
                $doctors[] = new Doctor($data);
            }
            return $doctors;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

}