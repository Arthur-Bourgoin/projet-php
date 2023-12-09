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

    public static function updateUser(array $args) {
        try {
            $req = Database::getInstance()->prepare("UPDATE usager
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
                                                     WHERE idUsager = :idUsager");
            $req->execute(array(
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
            return true;
        } catch (\Exception $e) {
            throw $e;
            return false;
        }
    }

    public static function deleteUser(int $id) {
        try {
            $req = Database::getInstance()->prepare('DELETE FROM usager WHERE idUsager = :idUsager');
            $req->execute(array("idUsager" => $id));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}