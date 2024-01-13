<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Config\Database;
use App\Class\Feedback;

final class TestAddDoctor extends TestCase
{

    public function setUp(): void {
        Database::getInstance()->exec("INSERT INTO medecin (idMedecin, civilite, nom, prenom, photo) VALUES (1000, 'M', 'Bourgoin', 'Arthur', '/user1000.png')");
    }

    public function tearDown(): void {
        Database::getInstance()->exec("DELETE FROM medecin WHERE idMedecin = 1000");
    }

    public function testBasic(): void
    {
        $this->assertEquals("test", "test");
    }

    public function test2(): void
    {
        $this->assertEquals(10, 11);
        $this->assertEquals("test", "test");
    }

    public function testUser() {
        $client = new Client();
        $response = $client->post("www.projet-php.local/medecins", [
            "form_params" => [
                "action" => "updateDoctor",
                "idDoctor" => "1000",
                "civility" => "F",
                "lastName" => "Bourgointt",
                "firstName" => "Arthure"
            ],
            "allow_redirects" => false
        ]);
        var_dump($response->getBody());
        $res = Database::getInstance()->query("SELECT * FROM medecin WHERE idMedecin = 1000");
        $user = $res->fetch();
        var_dump($user);
        $this->assertEquals("Bourgointt", $user->nom);
        $this->assertEquals("Arthure", $user->prenom);
    }

    public function testDelete() {
        $client = new Client();
        $client->post("www.projet-php.local/medecins", [
            "form_params" => [
                "action" => "deleteDoctor",
                "idDoctor" => "1000"
            ],
            "allow_redirects" => false
        ]);
        $res = Database::getInstance()->query("SELECT * FROM medecin WHERE idMedecin = 1000");
        $this->assertEquals(0, $res->rowCount());
    }

}