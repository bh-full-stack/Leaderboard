<?php

spl_autoload_register(function ($className) {
    include str_replace("\\", "/", $className) . ".php";
});

if ($_SERVER["REQUEST_URI"] == "/scores") {
    $controller = new \App\Controller\ScoreAPIController();
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $controller->list();
            break;
        case "POST":
            $controller->create();
            break;
        case "PUT":
        case "PATCH":
            $controller->update();
            break;
        case "DELETE":
            $controller->delete();
            break;
        default:
            $controller->list();
    }
} else {
    $controller = new \App\Controller\TopScoresController();
    $controller->index();
}