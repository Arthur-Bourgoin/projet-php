<?php

use PHPUnit\Framework\TestCase;
use config\database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\RdvController;

final class TestUpdateRDV extends TestCase {

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
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 09:00:00',
            "duration" => '60' //Modif here
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals(60, $rdv->duree);
    }

    public function testInvalidParams() {
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctorqsqsq" => 3,
            "dateTime" => '2025-01-21 09:00:00',
            "duration" => '60' //Modif here
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals(45, $rdv->duree);
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
        VALUES (25, 3, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:15:00', //Modif here
            "duration" => 45
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 25 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapDoctor2() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (25, 3, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:45:00', //Modif here
            "duration" => 45
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 25 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapDoctor3() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (25, 3, '2025-01-21 08:15:00', 45)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:20:00', //Modif here
            "duration" => 30 //Modif here
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 3 AND idUsager = 25 AND dateHeureDebut ='2025-01-21 08:15:00' ");
    }

    public function testOverlapDoctor4() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (25, 3, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:15:00', //Modif here
            "duration" => 60 //Modif here
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
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
        VALUES (24, 2, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:15:00', //Modif here
            "duration" => 45
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapUser2() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (24, 2, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:45:00', //Modif here
            "duration" => 45
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:30:00' ");
    }

    public function testOverlapUser3() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (24, 2, '2025-01-21 08:15:00', 45)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:20:00', //Modif here
            "duration" => 30 //Modif here
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:15:00' ");
    }

    public function testOverlapUser4() {
        Database::getInstance()->exec("INSERT INTO Rdv (idUsager, idMedecin, dateHeureDebut, duree)
        VALUES (24, 2, '2025-01-21 08:30:00', 30)");
        $_POST = [
            "idRdv" => 5555,
            "idUser" => 24,
            "idDoctor" => 3,
            "dateTime" => '2025-01-21 08:15:00', //Modif here
            "duration" => 60 //Modif here
        ];
        $this->controller->UpdateRdv();
        $res = Database::getInstance()->query("SELECT * FROM Rdv WHERE idRdv = 5555");
        $rdv = $res->fetch();
        $this->assertEquals('2025-01-21 09:00:00', $rdv->dateHeureDebut);
        Database::getInstance()->exec("DELETE FROM Rdv WHERE idMedecin = 2 AND idUsager = 24 AND dateHeureDebut ='2025-01-21 08:30:00' ");

    }


}