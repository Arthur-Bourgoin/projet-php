<?php
namespace app\models;
use config\Database;
use app\class\ {
    User,
    Doctor,
    Feedback
};

class UserModel {

    public static function getUsers() {
        try {
            $users = [];
            $res = Database::getInstance()->query("SELECT * FROM Usager ORDER BY nom");
            while ($data = $res->fetch()) {
                $users[] = new User($data);
            }
            return $users;
        } catch (\Exception $e) {
            throw $e;
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getUsersFilter(string $filter) {
        try {
            $users = [];
            $res = Database::getInstance()->prepare("SELECT * FROM Usager 
                                                     WHERE upper(nom) LIKE :filter 
                                                        OR upper(prenom) LIKE :filter
                                                     ORDER BY nom");
            $res->execute(array("filter" => "%" . strtoupper($filter) . "%"));
            while ($data = $res->fetch()) {
                $users[] = new User($data);
            }
            return $users;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getUser(int $id) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM Usager WHERE idUsager = :id");
            $res->execute(array("id" => $id));
            $user = $res->fetch();
            if(!$user)
                Feedback::setError("Erreur, l'usager n'existe pas.");
            else
                return new User($user);
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la récupération de l'usager.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addUser(array $args) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM Usager WHERE nir = :nir");
            $res->execute(array("nir" => $args["secuNumber"]));
            if($res->rowCount() !== 0) {
                Feedback::setError("Ajout impossible, l'usager existe déjà.");
                return;
            }
            $keys = ["picture", "secuNumber", "civility", "lastName", "firstName", "city", "postalCode", "address", "birthDate", "birthPlace", "idDoctor"];
            Database::getInstance()
                ->prepare("INSERT INTO Usager (photo, nir, civilite, nom, prenom, ville, codePostal, adresse, dateNaissance, lieuNaissance, idMedecin)
                           VALUES (:picture, :secuNumber, :civility, :lastName, :firstName, :city, :postalCode, :address, :birthDate, :birthPlace, :idDoctor)")
                ->execute(array_intersect_key($args, array_flip($keys)));
            Feedback::setSuccess("Ajout de l'usager enregistré.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de l'ajout de l'usager.");
        }
    }

    public static function updateUser(array $args) {
        try {
            if(!self::existUser($args["idUser"])) {
                Feedback::setError("Mise à jour impossible, l'usager n'existe pas.");
                return;
            }
            $keys = ["secuNumber", "civility", "lastName", "firstName", "city", "postalCode", "address", "birthDate", "birthPlace", "idDoctor", "idUser"];
            Database::getInstance()
                ->prepare("UPDATE Usager
                    SET nir = :secuNumber,
                        civilite = :civility,
                        nom = :lastName,
                        prenom = :firstName,
                        ville = :city,
                        codePostal = :postalCode,
                        adresse = :address,
                        dateNaissance = :birthDate,
                        lieuNaissance = :birthPlace,
                        idMedecin = :idDoctor
                    WHERE idUsager = :idUser")
                ->execute(array_intersect_key($args, array_flip($keys)));
            Feedback::setSuccess("Mise à jour de l'usager enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la mise à jour de l'usager.");
        }
    }

    public static function deleteUser(int $id) {
        try {
            if(!self::existUser($id)) {
                Feedback::setError("Suppression impossible, l'usager n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare('DELETE FROM Usager WHERE idUsager = :idUsager')
                ->execute(array("idUsager" => $id));
            Feedback::setSuccess("Suppression de l'usager enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la suppression de l'usager.");
        }
    }

    public static function existUser(int $idUser) {
        $res = Database::getInstance()->prepare("SELECT * FROM Usager WHERE idUsager = :id");
        $res->execute(array("id" => $idUser));
        return $res->rowCount() === 1;
    }

}