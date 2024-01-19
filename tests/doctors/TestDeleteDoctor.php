<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\Class\ {
    Feedback,
    UploadImg
};
use app\controllers\DoctorController;

final class TestDeleteDoctor extends TestCase {

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
            "idDoctor" => 9990
        ];
        $this->controller->DeleteDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE idMedecin = 9990");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testInvalidParams() {
        $_POST = [
            "idDoctorqsdqd" => 9990
        ];
        $this->controller->DeleteDoctor();
        $res = Database::getInstance()->query("SELECT * FROM Medecin WHERE idMedecin = 9990");
        $this->assertEquals(1, $res->rowCount());
    }
}