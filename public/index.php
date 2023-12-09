<?php
require_once("../vendor/autoload.php");

use App\Controllers\ {
    UserController,
    DoctorController
};

$router = new AltoRouter();

$router->map("GET", "/usagers", function () {
    $controller = new UserController();
    $controller->listUsers();
});
$router->map("GET", "/medecins", function () {
    $controller = new DoctorController();
    $controller->listDoctors();
});
$router->map("POST", "/usagers", function () {
    $controller = new UserController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "add":
                $controller->addUser();
                break;
            case "update":
                $controller->updateUser();
                break;
            case "delete":
                $controller->deleteUser();
                break;
        }
    } else {
        $controller->listUsers();
    }
});


$match = $router->match();
if($match != null) {
    call_user_func_array($match['target'], $match['params']);
} else {
    //require("../app/views/error404.php");
    echo "error404";
}