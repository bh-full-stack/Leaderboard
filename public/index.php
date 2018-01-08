<?php

spl_autoload_register(function ($className) {
    include "../" . str_replace("\\", "/", $className) . ".php";
});

if (php_sapi_name() == "cli") {
    if (isset($argv[1]) && $argv[1] == "seed") {
        $controller = new \App\Controller\SeedController();
        $controller->seed();
    } else {
        echo "Please add valid arguments\n";
    }
} else {
    if (explode("?", $_SERVER["REQUEST_URI"])[0] == "/scores") {
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
}