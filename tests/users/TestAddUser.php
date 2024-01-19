<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\UserController;

final class TestAddUser extends TestCase {

    private $uploadMock;
    private $controller;

    public function setUp(): void {
        $this->uploadMock = $this->createMock(UploadImg::class);
        $this->uploadMock->method('upload')->willReturn(true);
        $this->controller = new UserController($this->uploadMock);
        $_FILES = ["picture" => ["name" => "leNom"]];
    }

    public function tearDown(): void {
        Database::getInstance()->exec("DELETE FROM usager WHERE nir = '951753000369147'");
        $_POST = [];
    }

    public function testSuccess() {
        Database::getInstance()->exec("DELETE FROM usager WHERE nir = '951753000369147'");
        $_POST = [
            "lastName" => "Doe",
            "firstName" => "John",
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Paris",
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "2"
        ];
        $this->controller->addUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE nir = '951753000369147'");
        $this->assertEquals(1, $res->rowCount());
    }

    public function testInvalidParams() {
        $_POST = [
            "lastNamezzz" => "Doe", // error here
            "firstName" => "John",
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Paris",
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "2"
        ];
        $this->controller->addUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE nir = '951753000369147'");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testInvalidCivility() {
        $_POST = [
            "lastName" => "Doe",
            "firstName" => "John",
            "civility" => "Mww", // error here
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Paris",
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "2"
        ];
        $this->controller->addUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE nir = '951753000369147'");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testInvalidSecuNumber() {
        $_POST = [
            "lastName" => "Doe",
            "firstName" => "John",
            "civility" => "M",
            "secuNumber" => "95175300036914", // error here
            "birthDate" => "1970-01-01",
            "birthPlace" => "Paris",
            "postalCode" => "31400",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "2"
        ];
        $this->controller->addUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE nir = '951753000369147'");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testInvalidPostalCode() {
        $_POST = [
            "lastName" => "Doe",
            "firstName" => "John",
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Paris",
            "postalCode" => "314007", // error here
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "2"
        ];
        $this->controller->addUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE nir = '951753000369147'");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testUserExist() {
        Database::getInstance()->exec("INSERT INTO usager (photo, nir, civilite, nom, prenom, ville, codePostal, adresse, dateNaissance, lieuNaissance)
                                          VALUES ('user1000.png', '951753000369147', 'M', 'Doe', 'John', 'Toulouse', '31400', '18 avenue de rangueil', '1970-01-01', 'Paris')");
        $_POST = [
            "lastName" => "Doe",
            "firstName" => "John",
            "civility" => "M",
            "secuNumber" => "951753000369147",
            "birthDate" => "1970-01-01",
            "birthPlace" => "Paris",
            "postalCode" => "314007",
            "city" => "Toulouse",
            "address" => "18 avenue de Rangueil",
            "idDoctor" => "2"
        ];
        $this->controller->addUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE nir = '951753000369147'");
        $this->assertEquals(1, $res->rowCount());
    }

}