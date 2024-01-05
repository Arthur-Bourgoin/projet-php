<?php
namespace App\Controllers;

class ConnectionController {

    public function login() {
        if(isset($_SESSION["connected"])) {
            header("Location: /usagers");
            exit();
        }
        require("../app/views/connection.php");
    }

    public function verifLogin() {
        if(isset($_SESSION["connected"])) {
            header("Location: /usagers");
            exit();
        }
        if(empty($_POST["login"]) || empty($_POST["pwd"])) {
            header("Location: /connexion");
            exit();
        }
        if($_POST["login"] === "user" && password_verify($_POST["pwd"], "$2y$10$9dtB6gNfcR/Zj/BtHTlwXu0Jo/ukdEcAZRsxqg0XxepgaSZjfojVm")) {
            $_SESSION["connected"] = true;
            header("Location: /usagers");
        } else {
            header("Location: /connexion");
        }
    }

    public function disconnect() {
        unset($_SESSION["connected"]);
        header("Location: /usagers");
    }

}