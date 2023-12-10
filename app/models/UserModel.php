<?php
namespace App\Models;
use Config\Database;
use App\Class\ {
    User,
    Doctor
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
            return false;
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
                return 6;
            }
            Database::getInstance()
                ->prepare("INSERT INTO usager (photo, nir, civilite, nom, prenom, ville, codePostal, adresse, dateNaissance, lieuNaissance, idMedecin)
                           VALUES (:photo, :nir, :civilite, :nom, :prenom, :ville, :codePostal, :adresse, :dateNaissance, :lieuNaissance, :idMedecin)")
                ->execute(array(
                    "photo" => $_POST["picturePath"],
                    "nir" => $_POST["secuNumber"],
                    "civilite" => $_POST["civility"],
                    "nom" => $_POST["lastName"],
                    "prenom" => $_POST["firstName"],
                    "ville" => $_POST["city"],
                    "codePostal" => $_POST["postalCode"],
                    "adresse" => $_POST["address"],
                    "dateNaissance" => $_POST["birthDate"],
                    "lieuNaissance" => $_POST["birthPlace"],
                    "idMedecin" => $_POST["idDoctor"]
                ));
            return 0;
        } catch (\Exception $e) {
            return 7;
        }
    }

    public static function updateUser(array $args) {
        try {
            Database::getInstance()
                ->prepare("UPDATE usager
                    SET nir = :nir,
                        civilite = :civilite,
                        nom = :nom,
                        prenom = :prenom,
                        ville = :ville,
                        codePostal = :codePostal,
                        adresse = :adresse,
                        dateNaissance = :dateNaissance,
                        lieuNaissance = :lieuNaissance,
                        idMedecin = :idMedecin
                    WHERE idUsager = :idUsager")
                ->execute(array(
                    "nir" => $_POST["secuNumber"],
                    "civilite" => $_POST["civility"],
                    "nom" => $_POST["lastName"],
                    "prenom" => $_POST["firstName"],
                    "ville" => $_POST["city"],
                    "codePostal" => $_POST["postalCode"],
                    "adresse" => $_POST["address"],
                    "dateNaissance" => $_POST["birthDate"],
                    "lieuNaissance" => $_POST["birthPlace"],
                    "idMedecin" => $_POST["idDoctor"],
                    "idUsager" => $_POST["idUser"]
                ));
            return 0;
        } catch (\Exception $e) {
            return 3;
        }
    }

    public static function deleteUser(int $id) {
        try {
            Database::getInstance()
                ->prepare('DELETE FROM usager WHERE idUsager = :idUsager')
                ->execute(array("idUsager" => $id));
            return 0;
        } catch (\Exception $e) {
            return 4;
        }
    }

}