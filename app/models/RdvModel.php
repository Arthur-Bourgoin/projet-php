<?php
namespace App\Models;
use Config\Database;
use App\Class\ {
    User,
    Doctor,
    Rdv,
    Feedback
};

class RdvModel {

    public static function getRdvs() {
        try {
            $rdvs = [];
            $res = Database::getInstance()->query("SELECT * FROM rdv ORDER BY dateHeureDebut");
            while($rdv = $res->fetch()) {
                $user = UserModel::getUser($rdv->idUsager);
                $doctor = DoctorModel::getDoctor($rdv->idMedecin);
                $rdvs[] = new Rdv($rdv, $user, $doctor);
            }
            return $rdvs;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getRdvsByDoctor(string $idDoctor) {
        try {
            $rdvs = [];
            $res = Database::getInstance()->prepare("SELECT * FROM rdv WHERE idMedecin = :idDoctor");
            $res->execute(array("idDoctor" => $idDoctor));
            while($rdv = $res->fetch()) {
                $user = UserModel::getUser($rdv->idUsager);
                $doctor = DoctorModel::getDoctor($rdv->idMedecin);
                $rdvs[] = new Rdv($rdv, $user, $doctor);
            }
            return $rdvs;
        } catch (\Exception $e) {
            throw $e;
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }
    
}