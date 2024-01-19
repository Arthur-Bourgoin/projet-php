<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\RdvController;

final class TestDeleteRDV extends TestCase {

    private $uploadMock;
    private $controller;

    public function setUp(): void {
        $this->uploadMock = $this->createMock(UploadImg::class);
        $this->uploadMock->method('upload')->willReturn(true);
        $this->controller = new RdvController($this->uploadMock);
        $_FILES = ["picture" => ["name" => "leNom"]];
        Database::getInstance()->exec("INSERT INTO Rdv (idRdv, idUsager, idMedecin, dateHeureDebut, duree)
                                        VALUES (5555, 24, 3, '2025-01-21 09:00:00', 45)");
    }

    public function tearDown(): void {
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idRdv = 5555");
        $_POST = [];
    }

    public function testSuccess() {
        $_POST = [
            "idRdv" => 5555,
        ];
        $this->controller->DeleteRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testInvalidRDV() {
        $_POST = [
            "idRdvqssq" => 5555,
        ];
        $this->controller->DeleteRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $this->assertEquals(1, $res->rowCount());

    }

}