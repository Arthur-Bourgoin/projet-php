<?php
namespace app\controllers;
use app\class\Feedback;

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
            Feedback::setError("Erreur, le champ de login ou de mot de passe n'a pas été rempli.");
            header("Location: /connexion");
            exit();
        }
        if($_POST["login"] === "user" && password_verify($_POST["pwd"], "$2y$10$9dtB6gNfcR/Zj/BtHTlwXu0Jo/ukdEcAZRsxqg0XxepgaSZjfojVm")) {
            $_SESSION["connected"] = true;
            header("Location: /usagers");
        } else {
            Feedback::setError("Identifiant ou mot de passe incorrect.");
            header("Location: /connexion");
        }
    }

    public function disconnect() {
        unset($_SESSION["connected"]);
        header("Location: /usagers");
    }

}