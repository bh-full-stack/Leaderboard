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
    $message = $player->save();

    header('Location: index.php?message=' . $message);
}