<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\DoctorController;

final class TestAddDoctor extends TestCase {

    private $uploadMock;
    private $controller;

    public function setUp(): void {
        $this->uploadMock = $this->createMock(UploadImg::class);
        $this->uploadMock->method('upload')->willReturn(true);
        $this->controller = new DoctorController($this->uploadMock);
        $_FILES = ["picture" => ["name" => "leNom"]];
    }

    public function tearDown(): void {
        Database::getInstance()->exec("DELETE FROM Medecin WHERE nom = 'Boucher' and prenom = 'Fred'");
        $_POST = [];
    }

    public function testSuccess() {
        $_POST = [
            "lastName" => "Boucher",
            "firstName" => "Fred",
            "civility" => "M"
        ];
        $this->controller->addDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE nom = 'Boucher' and prenom = 'Fred'");
        $this->assertEquals(1, $res->rowCount());
    }

    public function testInvalidParams() {
        $_POST = [
            "lastNamesqdqsd" => "Boucher",
            "firstName" => "Fred",
            "civility" => "M"
        ];
        $this->controller->addDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE nom = 'Boucher' and prenom = 'Fred'");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testInvalidCivility() {
        $_POST = [
            "lastName" => "Boucher",
            "firstName" => "Fred",
            "civility" => "Msds"
        ];
        $this->controller->addDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE nom = 'Boucher' and prenom = 'Fred'");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testWithoutImg() {
        unset($_FILES);
        $_POST = [
            "lastName" => "Boucher",
            "firstName" => "Fred",
            "civility" => "M"
        ];
        $this->controller->addDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE nom = 'Boucher' and prenom = 'Fred'");
        $this->assertEquals(0, $res->rowCount());
    }
}