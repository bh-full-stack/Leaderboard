<?php
require 'service/GeolocationService.php';

spl_autoload_register(function ($class_name) {
    include "model/$class_name.php";
});

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $player = new Player;
        $player->nick = $_POST['nick'];
        $player->game = $_POST['game'];
        $player->score = $_POST['score'];
        $player->setLocation(GeolocationService::getLocation());
        $player->save();

        if (strpos($_SERVER["HTTP_ACCEPT"], "text/html") !== false) {
            $message = "New record created successfully";
            header('Location: index.php?message=' . $message);
        } else if (strpos($_SERVER["HTTP_ACCEPT"], "application/json") !== false) {
            header("Access-Control-Allow-Origin: *");
            echo json_encode($player->getAttributes());
        } else {
            throw (new UserException)->setCode(UserException::COMMUNICATION_ERROR);
        }
    } catch (UserException $e) {
        header($e->getHttpHeader());
        if (strpos($_SERVER["HTTP_ACCEPT"], "text/html") !== false) {
            $message = $e->getMessage();
            header('Location: index.php?message=' . $message);
        } else if (strpos($_SERVER["HTTP_ACCEPT"], "application/json") !== false) {
            header("Access-Control-Allow-Origin: *");
            echo json_encode(["code" => $e->getCode(), "message" => $e->getMessage()]);
        } else {
            die($e->getMessage());
        }
    }
}