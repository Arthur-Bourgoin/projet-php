<?php

use PHPUnit\Framework\TestCase;
use config\Database;
use app\class\ {
    Feedback,
    UploadImg
};
use app\controllers\UserController;

final class TestDeleteUser extends TestCase {

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
            "idUser" => "1000"
        ];
        $this->controller->deleteUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $this->assertEquals(0, $res->rowCount());
    }

    public function testInvalidParam() {
        $_POST = [
            "idUserzzz" => "1000"
        ];
        $this->controller->deleteUser();
        $res = Database::getInstance()->query("SELECT * FROM usager WHERE idUsager = 1000");
        $this->assertEquals(1, $res->rowCount());
    }

}