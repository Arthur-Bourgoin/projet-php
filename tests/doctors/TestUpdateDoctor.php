<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\DoctorController;

final class TestUpdateDoctor extends TestCase {

    private $uploadMock;
    private $controller;

    public function setUp(): void {
        $this->uploadMock = $this->createMock(UploadImg::class);
        $this->uploadMock->method('upload')->willReturn(true);
        $this->controller = new DoctorController($this->uploadMock);
        $_FILES = ["picture" => ["name" => "leNom"]];
        Database::getInstance()->exec("INSERT INTO Medecin (idMedecin, civilite, photo, nom, prenom)
                                                VALUES (9990, 'M', 'user9990.png', 'Boucher', 'Fred')");

    }

    public function tearDown(): void {
        Database::getInstance()->exec("DELETE FROM Medecin WHERE idMedecin = 9990");
        $_POST = [];
    }

    public function testSuccess() {
        $_POST = [
            "idDoctor" => 9990,
            "lastName" => "Pierre", //modif Here
            "firstName" => "Fred",
            "civility" => "M"
        ];
        $this->controller->UpdateDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE idMedecin = 9990");
        $user = $res->fetch();
        $this->assertEquals("Pierre", $user->nom);
    }

    public function testInvalidParams() {
        $_POST = [
            "idDoctor" => 9990,
            "lastName" => "Pierre", //modif Here
            "firstNamqsdqsdqsde" => "Fred", //ERROR HERE
            "civility" => "M"
        ];
        $this->controller->UpdateDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE idMedecin = 9990");
        $user = $res->fetch();
        $this->assertEquals("Boucher", $user->nom);
    }


    public function testInvalidCivility() {
        $_POST = [
            "idDoctor" => 9990,
            "lastName" => "Pierre", //modif Here
            "firstName" => "Fred", 
            "civility" => "Msqqs" //ERROR HERE
        ];
        $this->controller->UpdateDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE idMedecin = 9990");
        $user = $res->fetch();
        $this->assertEquals("Boucher", $user->nom);
    }

/*  A finir
    public function testInvalidCivility() {
        $_POST = [
            "idDoctor" => 9999,
            "lastName" => "Pierre", //modif Here
            "firstName" => "Fred", 
            "civility" => "Msqqs" //ERROR HERE
        ];
        $this->controller->UpdateDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE idMedecin = 9999");
        $user = $res->fetch();
        $this->assertEquals("Boucher", $user->nom);
    }*/
}