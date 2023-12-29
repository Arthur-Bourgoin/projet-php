<?php
namespace App\Models;
use Config\Database;
use App\Class\ {
    User,
    Doctor,
    Feedback
};

class UserModel {

    public static function getUsers() {
        try {
            $users = [];
            $res = Database::getInstance()->query("SELECT * FROM usager");
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

    public static function addUser(array $args) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM usager WHERE nir = :nir");
            $res->execute(array("nir" => $_POST["secuNumber"]));
            if($res->rowCount() !== 0) {
                Feedback::setError("Ajout impossible, l'usager existe déjà.");
                return;
            }
            $args["picture"] = "user1.png";
            $keys = ["picture", "secuNumber", "civility", "lastName", "firstName", "city", "postalCode", "address", "birthDate", "birthPlace", "idDoctor"];
            Database::getInstance()
                ->prepare("INSERT INTO usager (photo, nir, civilite, nom, prenom, ville, codePostal, adresse, dateNaissance, lieuNaissance, idMedecin)
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
                ->prepare("UPDATE usager
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
            throw $e;
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
                ->prepare('DELETE FROM usager WHERE idUsager = :idUsager')
                ->execute(array("idUsager" => $id));
            Feedback::setSuccess("Suppression de l'usager enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la suppression de l'usager.");
        }
    }

    public static function existUser(int $idUser) {
        $res = Database::getInstance()->prepare("SELECT * FROM usager WHERE idUsager = :id");
        $res->execute(array("id" => $idUser));
        return $res->rowCount() === 1;
    }

}