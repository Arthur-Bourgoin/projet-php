<?php
require_once("../vendor/autoload.php");

use App\Controllers\ {
    UserController,
    DoctorController,
    StatsController,
    RdvController,
    ConnectionController
};

session_start();

if(!isset($_SESSION["connected"]) && $_SERVER["REQUEST_URI"] !== "/connexion") header("Location: /connexion");
if($_SERVER["REQUEST_URI"] !== "/consultations") unset($_SESSION["rdv"]);

$router = new AltoRouter();

$router->map("GET", "/test", function () {
    $date = new DateTime('2023-12-06 12:30:00');
    echo $date->format('Y-m-d H:i:s') . "</br>";
    $date->modify('+15 minutes');
    echo $date->format('Y-m-d H:i:s') . "</br>";
});

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
$router->map("GET", "/", function () {
    header("Location: /usagers");
});
$router->map("GET", "/usagers", function () {
    $controller = new UserController(null);
    $controller->listUsers();
});
$router->map("POST", "/usagers", function () {
    $controller = new UserController(null);
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
    }
    header("Location: " . $_SERVER["REQUEST_URI"]);
});

/*##########     MEDECINS     ##########*/
$router->map("GET", "/medecins", function () {
    $controller = new DoctorController(null);
    $controller->listDoctors();
});
$router->map("POST", "/medecins", function () {
    $controller = new DoctorController(null);
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
    }
    header("Location: " . $_SERVER["REQUEST_URI"]);
});

/*##########     CONSULTATIONS     ##########*/
$router->map("GET", "/consultations", function () {
    $controller = new RdvController();
    $controller->displayPage();
});
$router->map("POST", "/consultations", function () {
    $controller = new RdvController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "filterTable":
                $controller->filterTable();
                break;
            case "addRdv":
                $controller->addRdv();
                break;
        }
    }
    header("Location: " . $_SERVER["REQUEST_URI"]);
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