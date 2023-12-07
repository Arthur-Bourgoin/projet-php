<?php
require_once("../vendor/autoload.php");

use App\Controllers\Controller;

$router = new AltoRouter();

$router->map("GET", "/usagers", function () {
    $controller = new Controller();
    $controller->listUsers();
});
$router->map("GET", "/medecins", function () {
    $controller = new Controller();
    $controller->listDoctors();
});


$match = $router->match();
if($match != null) {
    call_user_func_array($match['target'], $match['params']);
} else {
    //require("../app/views/error404.php");
    echo "error404";
}