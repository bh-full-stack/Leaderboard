<?php

require 'model/Player.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $player = new Player;
    $player->nick = $_POST['nick'];
    $player->game = $_POST['game'];
    $player->score = $_POST['score'];

    $clientIp = $_SERVER['REMOTE_ADDR'];
    $clientIp = '89.135.190.25';
    $jsonString = file_get_contents("http://ip-api.com/json/$clientIp");
    $jsonObject = json_decode($jsonString);

    $player->country = $jsonObject->country;
    $player->city = $jsonObject->city;
    $status = $player->save();

    if (strpos($_SERVER["HTTP_ACCEPT"], "text/html") !== false) {
        if ($status) {
            $message = "New record created successfully";
        } else {
            $message = "Invalid input or system failure";
        }
        header('Location: index.php?message=' . $message);
    } else if (strpos($_SERVER["HTTP_ACCEPT"], "application/json") !== false) {
        header("Access-Control-Allow-Origin: *");
        echo json_encode(["success" => $status]);
    } else {
        die("error");
    }
}