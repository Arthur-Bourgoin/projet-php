<?php
namespace App\Models;
use Config\Database;
use App\Class\Doctor;

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
            return false;
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

}