<?php

require "../autoload.php";

if (php_sapi_name() == "cli") {
    if (isset($argv[1]) && $argv[1] == "seed") {
        $controller = new \App\Controller\SeedController();
        $controller->seed();
    } elseif (isset($argv[1]) && $argv[1] == "migrate" && isset($argv[2])) {
        $controller = new \App\Controller\MigrateController();
        $controller->migrate($argv[2]);
    } else {
        echo "Please add valid arguments\n";
    }
} else {
    if ($_SERVER["REQUEST_URI"] == "/scores") {
        $controller = new \App\Controller\RoundController();
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
    } elseif ($_SERVER["REQUEST_URI"] == "/sign-up") {
        $controller = new \App\Controller\SignUpController();
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $controller->index();
                break;
            case "POST":
                $controller->create();
                break;
        }
    } elseif ($_SERVER["REQUEST_URI"] == "/test") {
        $location = new \App\Model\Location();
        $location->country = "Hungary";
        $location->city = "Budapest";
        $id = $location->save();
    } else {
        $controller = new \App\Controller\TopScoresController();
        $controller->index();
    }
}