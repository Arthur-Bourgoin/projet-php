<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\RdvController;

final class TestAddRDV extends TestCase {

    private $uploadMock;
    private $controller;

    public function setUp(): void {
        $this->uploadMock = $this->createMock(UploadImg::class);
        $this->uploadMock->method('upload')->willReturn(true);
        $this->controller = new RdvController($this->uploadMock);
        $_FILES = ["picture" => ["name" => "leNom"]];
    }

    public function tearDown(): void {
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3   AND idUsager = 24 AND dateHeureDebut ='2025-01-21 09:00:00' ");
        $_POST = [];
    }

    public function testSuccess() {
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 09:00:00' ");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 09:00:00',
            "duration" => 45
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 09:00:00' ");
        $this->assertEquals(1, $res->rowCount());
    }

    public function testInvalidParams() {
        $_POST = [
            "idUser" => 24, //ERROR HERE
            "idDoctorSQSD" => 3,
            "dateTime" => '2025-01-21 09:00:00',
            "duration" => 45
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 09:00:00' ");
        $this->assertEquals(0, $res->rowCount());
    }

     /*
    ----- : new rdv
    [   ] : rdvs in database
    2 cases of overlap :
        1 ->    [     -----]-----
        2 ->    -----[-----     ]
        3 ->    --[------]--     --> inutile
        4 ->    [  ----------  ] --> inutile
    */

    public function testOverlapDoctor1() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (25, 3, '2025-01-21 08:30:00', 45)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 09:00:00',
            "duration" => 30
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 09:00:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 25 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapDoctor2() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (25, 3, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:00:00',
            "duration" => 45
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 08:00:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 25 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapDoctor3() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (25, 3, '2025-01-21 08:30:00', 60)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:45:00',
            "duration" => 30
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 08:45:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 25 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapDoctor4() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (25, 3, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:15:00',
            "duration" => 60
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 08:15:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 25 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }


    /*
    ----- : new rdv
    [   ] : rdvs in database
    2 cases of overlap :
        1 ->    [     -----]-----
        2 ->    -----[-----     ]
        3 ->    --[------]--     --> inutile
        4 ->    [  ----------  ] --> inutile
    */

    public function testOverlapUser1() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (24, 2, '2025-01-21 08:30:00', 45)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 09:00:00',
            "duration" => 30
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 09:00:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapUser2() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (24, 2, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:00:00',
            "duration" => 45
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 08:00:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapUser3() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (24, 2, '2025-01-21 08:30:00', 60)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:45:00',
            "duration" => 30
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 08:45:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapUser4() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (24, 2, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:15:00',
            "duration" => 60
        ];
        $this->controller->addRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idMedecin = 3 and idUsager = 24 AND dateHeureDebut ='2025-01-21 08:15:00' ");
        $this->assertEquals(0, $res->rowCount());
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }


}