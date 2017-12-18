<?php

$servername = "localhost";
$username = "root";
$password = "mob";
$dbname = "leaderboard";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $game = $_POST['game'];
    $score = $_POST['score'];

    $clientIp = $_SERVER['REMOTE_ADDR'];
    $clientIp = '89.135.190.25';
    $jsonString = file_get_contents("http://ip-api.com/json/$clientIp");
    $jsonObject = json_decode($jsonString);

    $country = $jsonObject->country;
    $city = $jsonObject->city;

    if (empty($nick)) {
        $message = "Name is empty";
    } else {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO players (nick, game, score, country, city) 
                    VALUES (:nick, :game, :score, :country, :city)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nick', $nick);
            $stmt->bindParam(':game', $game);
            $stmt->bindParam(':score', $score);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':city', $city);
            $stmt->execute();
            $message = "New record created successfully";
        } catch(PDOException $e) {
            $message = "Invalid input or system failure";
        }
    }
    header('Location: index.php?message=' . $message);
}