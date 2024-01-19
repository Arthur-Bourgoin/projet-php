<?php
namespace app\models;
use config\Database;
use app\class\ {
    Doctor,
    Feedback
};

class DoctorModel {

    public static function getDoctors() {
        try {
            $doctors = [];
            $res = Database::getInstance()->query("SELECT * FROM medecin ORDER BY nom");
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

    public static function getDoctor(int $id) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM medecin WHERE idMedecin = :id");
            $res->execute(array("id" => $id));
            $doctor = $res->fetch();
            if(!$doctor)
                Feedback::setError("Erreur, le médecin n'existe pas.");
            else
                return new Doctor($doctor);
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la récupération du médecin.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getDurationRdv(int $idDoctor) {
        try {
            if(!self::existDoctor($idDoctor)) {
                Feedback::setError("Une erreur s'est produite lors du chargement des graphiques.");
                return;
            }
            $res = Database::getInstance()->prepare("SELECT sum(duree)/60 as duree FROM rdv WHERE idMedecin = :id");
            $res->execute(array("id" => $idDoctor));
            $duration = $res->fetch()->duree;
            return $duration ? $duration : 0;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement des graphiques.");
        }
    }

    public static function addDoctor(array $args) {
        try {
            Database::getInstance()
                ->prepare("INSERT INTO medecin (civilite, nom, prenom, photo)
                           VALUES (:civility, :lastName, :firstName, :picture)")
                ->execute(array_intersect_key($args, array_flip(["civility", "lastName", "firstName", "picture"])));
            Feedback::setSuccess("Ajout du médecin enregistré.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de l'ajout du médecin.");
        }
    }

    public static function updateDoctor(array $args) {
        try {
            if(!self::existDoctor($_POST["idDoctor"])) {
                Feedback::setError("Mise à jour impossible, le médecin n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("UPDATE medecin
                            SET civilite = :civility,
                                nom = :lastName,
                                prenom = :firstName
                            WHERE idMedecin = :idDoctor")
                ->execute(array_intersect_key($args, array_flip(["civility", "lastName", "firstName", "idDoctor"])));
            Feedback::setSuccess("Mise à jour du médecin enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la mise à jour de l'utilisateur.");
        }
    }

    public static function deleteDoctor(int $id) {
        try {
            if(!self::existDoctor($id)) {
                Feedback::setError("Suppression impossible, le médecin n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("DELETE FROM medecin WHERE idMedecin = :id")
                ->execute(array("id" => $id));
            Feedback::setSuccess("Suppression du médecin enregistrée.");
        } catch (\Exception $e) {
            throw $e;
            Feedback::setError("Une erreur s'est produite lors de la suppression du médecin.");
        }        
    }

    private static function existDoctor(int $id) {
        $res = Database::getInstance()->prepare("SELECT * FROM medecin WHERE idMedecin = :id");
        $res->execute(array("id" => $id));
        return $res->rowCount();
    }

}