<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\UserController;

final class TestUpdateUser extends TestCase {

    private $controller;

    public function setUp(): void {
        $this->controller = new UserController(null);
        Database::getInstance()->exec("INSERT INTO usager (idUsager, photo, nir, civilite, nom, prenom, ville, codePostal, adresse, dateNaissance, lieuNaissance, idMedecin)
                                          VALUES (1000, 'user1000.png', '951753000369147', 'M', 'Doe', 'John', 'Toulouse', '31400', '18 avenue de rangueil', '1970-01-01', 'Paris', 2)");
    }

    public function tearDown(): void {
        Database::getInstance()->exec("DELETE FROM usager WHERE idUsager = 1000");
        $_POST = [];
    }

    public function testSuccess() {
        $_POST = [
            "idUser" => "1000",
            "lastName" => "Doe",
            "firstName" => "Jake", // modif name
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Bordeaux", // modif birthPlace
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "1" // modif idDoctor
        ];
        $this->controller->updateUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $user = $res->fetch();
        $this->assertEquals("Jake", $user->prenom);
        $this->assertEquals("Bordeaux", $user->lieuNaissance);
        $this->assertEquals(1, $user->idMedecin);
    }

    public function testInvalidParams() {
        $_POST = [
            "idUser" => "1000",
            "lastNamezzz" => "Doe", // error here
            "firstName" => "Jake", // modif name
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Bordeaux", // modif birthPlace
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "1" // modif idDoctor
        ];
        $this->controller->updateUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $user = $res->fetch();
        $this->assertEquals("John", $user->prenom);
        $this->assertEquals("Paris", $user->lieuNaissance);
        $this->assertEquals(2, $user->idMedecin);
    }

    public function testInvalidCivility() {
        $_POST = [
            "idUser" => "1000",
            "lastName" => "Doe",
            "firstName" => "Jake", // modif name
            "civility" => "Mzz", // error here
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Bordeaux", // modif birthPlace
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "1" // modif idDoctor
        ];
        $this->controller->updateUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $user = $res->fetch();
        $this->assertEquals("John", $user->prenom);
        $this->assertEquals("Paris", $user->lieuNaissance);
        $this->assertEquals(2, $user->idMedecin);
    }

    public function testInvalidSecuNumber() {
        $_POST = [
            "idUser" => "1000",
            "lastName" => "Doe",
            "firstName" => "Jake", // modif name
            "civility" => "M",
            "secuNumber" => "95175300036914", // error here
            "birthDate" => "1970-01-01",
            "birthPlace" => "Bordeaux", // modif birthPlace
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "1" // modif idDoctor
        ];
        $this->controller->updateUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $user = $res->fetch();
        $this->assertEquals("John", $user->prenom);
        $this->assertEquals("Paris", $user->lieuNaissance);
        $this->assertEquals(2, $user->idMedecin);
    }

    public function testInvalidPostalCode() {
        $_POST = [
            "idUser" => "1000",
            "lastName" => "Doe",
            "firstName" => "Jake", // modif name
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Bordeaux", // modif birthPlace
            "postalCode" => "3140p", // error here
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "1" // modif idDoctor
        ];
        $this->controller->updateUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $user = $res->fetch();
        $this->assertEquals("John", $user->prenom);
        $this->assertEquals("Paris", $user->lieuNaissance);
        $this->assertEquals(2, $user->idMedecin);
    }

    public function testDoctorNotExist() {
        $_POST = [
            "idUser" => "1000",
            "lastName" => "Doe",
            "firstName" => "Jake", // modif name
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Bordeaux", // modif birthPlace
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "12345" // modif idDoctor
        ];
        $this->controller->updateUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $user = $res->fetch();
        $this->assertEquals("John", $user->prenom);
        $this->assertEquals("Paris", $user->lieuNaissance);
        $this->assertEquals(2, $user->idMedecin);
    }

}