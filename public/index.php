<?php
require_once("../vendor/autoload.php");

use App\Controllers\ {
    UserController,
    DoctorController,
    StatsController,
    ConnectionController
};

session_start();

if(!isset($_SESSION["connected"]) && $_SERVER["REQUEST_URI"] !== "/connexion") {
    header("Location: /connexion");
}

$router = new AltoRouter();

/*##########     CONNEXION     ##########*/
$router->map("GET", "/connexion", function () {
    $controller = new ConnectionController();
    $controller->login();
});
$router->map("POST", "/connexion", function () {
    $controller = new ConnectionController();
    $controller->verifLogin();
});
$router->map("GET", "/disconnect", function () {
    $controller = new ConnectionController();
    $controller->disconnect();
});

/*##########     USAGERS     ##########*/
$router->map("GET", "/usagers", function () {
    $controller = new UserController();
    $controller->listUsers();
});
$router->map("POST", "/usagers", function () {
    $controller = new UserController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "addUser":
                $controller->addUser();
                break;
            case "updateUser":
                $controller->updateUser();
                break;
            case "deleteUser":
                $controller->deleteUser();
                break;
        }
        header("Location: " . $_SERVER["REQUEST_URI"]);
    } else {
        $controller->listUsers();
    }
});

/*##########     MEDECINS     ##########*/
$router->map("GET", "/medecins", function () {
    $controller = new DoctorController();
    $controller->listDoctors();
});
$router->map("POST", "/medecins", function () {
    $controller = new DoctorController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "addDoctor":
                $controller->addDoctor();
                break;
            case "updateDoctor":
                $controller->updateDoctor();
                break;
            case "deleteDoctor":
                $controller->deleteDoctor();
                break;
        }
        header("Location: " . $_SERVER["REQUEST_URI"]);
    } else {
        $controller->listDoctors();
    }
});

/*##########     CONSULTATIONS     ##########*/
$router->map("GET", "/consultations", function () {
    echo "page consultations";
});

/*##########     STATISTIQUES     ##########*/
$router->map("GET", "/statistiques", function () {
    $controller = new StatsController();
    $controller->displayPage();
});


$match = $router->match();
if($match != null) {
    call_user_func_array($match['target'], $match['params']);
} else {
    //require("../app/views/error404.php");
    echo "error404";
}