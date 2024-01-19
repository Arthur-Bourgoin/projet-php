<?php
namespace app\models;
use config\Database;
use app\class\ {
    User,
    Doctor,
    Rdv,
    Feedback
};

class RdvModel {

    public static function getRdvs(int $idDoctor, int $idUser) {
        try {
            $rdvs = [];
            if($idDoctor == 0 && $idUser == 0) {
                $res = Database::getInstance()->query("SELECT * FROM rdv ORDER BY dateHeureDebut DESC");
            } elseif($idDoctor == 0) {
                $res = Database::getInstance()->prepare("SELECT * FROM rdv WHERE idUsager = :idUser ORDER BY dateHeureDebut DESC");
                $res->execute(array("idUser" => $idUser));
            } elseif($idUser == 0) {
                $res = Database::getInstance()->prepare("SELECT * FROM rdv WHERE idMedecin = :idDoctor ORDER BY dateHeureDebut DESC");
                $res->execute(array("idDoctor" => $idDoctor));
            } else {
                $res = Database::getInstance()->prepare("SELECT * FROM rdv WHERE idMedecin = :idDoctor AND idUsager = :idUser ORDER BY dateHeureDebut DESC");
                $res->execute(array("idDoctor" => $idDoctor, "idUser" => $idUser));
            }
            while($rdv = $res->fetch()) {
                $user = UserModel::getUser($rdv->idUsager);
                $doctor = DoctorModel::getDoctor($rdv->idMedecin);
                $rdvs[] = new Rdv($rdv, $user, $doctor);
            }
            return $rdvs;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if($res != null) $res->closeCursor();
        }
    }

    /*
    ----- : new rdv
    [   ] : rdvs in database
    2 cases of overlap :
        1 ->    [     -----]-----
        2 ->    -----[-----     ]
        3 ->    --[------]--     --> inutile
        4 ->    [  ----------  ] --> inutile
    */
    public static function isOverlapRdvDoctor(array $args) {
        try {
            $req = "SELECT * FROM RDV
                    WHERE idMedecin = :idDoctor
                        AND ( (:dateTime >= dateHeureDebut AND :dateTime < dateHeureDebut + INTERVAL duree MINUTE) 
                            OR
                            (:dateTime <= dateHeureDebut AND :dateTime + INTERVAL :duration MINUTE > dateHeureDebut) )";
            // not to take into account the appointment that is being modified
            if(!empty($args["idRdv"]))
                $req .= " AND idRdv != :idRdv";
            $res = Database::getInstance()->prepare($req);
            if(!empty($args["idRdv"]))
                $res->bindValue(':idRdv', $args['idRdv'], \PDO::PARAM_INT);
            $res->bindValue(':dateTime', $args['dateTime'], \PDO::PARAM_STR);
            $res->bindValue(':idDoctor', $args['idDoctor'], \PDO::PARAM_INT);
            $res->bindValue(':duration', $args['duration'], \PDO::PARAM_INT);
            $res->execute();
            return $res->rowCount() != 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function isOverlapRdvUser(array $args) {
        try {
            $req = "SELECT * FROM RDV
                    WHERE idUsager = :idUser
                        AND ( (:dateTime >= dateHeureDebut AND :dateTime < dateHeureDebut + INTERVAL duree MINUTE) 
                            OR
                            (:dateTime <= dateHeureDebut AND :dateTime + INTERVAL :duration MINUTE > dateHeureDebut) )";
            // not to take into account the appointment that is being modified
            if(!empty($args["idRdv"]))
                $req .= " AND idRdv != :idRdv";
            $res = Database::getInstance()->prepare($req);
            if(!empty($args["idRdv"]))
                $res->bindValue(':idRdv', $args['idRdv'], \PDO::PARAM_INT);
            $res->bindValue(':dateTime', $args['dateTime'], \PDO::PARAM_STR);
            $res->bindValue(':idUser', $args['idUser'], \PDO::PARAM_INT);
            $res->bindValue(':duration', $args['duration'], \PDO::PARAM_INT);
            $res->execute();
            return $res->rowCount() != 0;
        } catch (\Exception $e) {
            return false;
        }
    }
    

    public static function addRdv(array $args) {
        try {
            Database::getInstance()
                ->prepare("INSERT INTO rdv (idMedecin, idUsager, dateHeureDebut, duree)
                           VALUES (:idDoctor, :idUser, :dateTime, :duration)")
                ->execute(array_intersect_key($args, array_flip(["idDoctor", "idUser", "dateTime", "duration"])));
            Feedback::setSuccess("Ajout de la consultation enregistré.");
        } catch(\Exception $e) {
            Feedback::setError("Une erreur est survenue lors de l'ajout de la consultation.");
        }
    }

    public static function updateRdv(array $args) {
        try {
            if(!self::existRdv($args["idRdv"])) {
                Feedback::setError("Mise à jour impossible, la consultation n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("UPDATE rdv
                           SET idMedecin = :idDoctor,
                               idUsager = :idUser,
                               dateHeureDebut = :dateTime,
                               duree = :duration
                           WHERE idRdv = :idRdv")
                ->execute(array_intersect_key($args, array_flip(["idRdv", "idDoctor", "idUser", "dateTime", "duration"])));
            Feedback::setSuccess("Mise à jour de la consultation enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la mise à jour de la consultation.");
        }
    }

    public static function deleteRdv(int $idRdv) {
        try {
            if(!self::existRdv($idRdv)) {
                Feedback::setError("Supression impossible la consultation n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("DELETE FROM rdv WHERE idRdv = :idRdv")
                ->execute(array("idRdv" => $idRdv));
            Feedback::setSuccess("La suppression de la consultation a été enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la suppression de la consultation.");
        } 
    }

    private static function existRdv(int $idRdv) {
        $res = Database::getInstance()->prepare("SELECT * FROM rdv WHERE idRdv = :idRdv");
        $res->execute(array("idRdv" => $idRdv));
        return $res->rowCount() == 1; 
    }
    
}