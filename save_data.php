<?php

$servername = "localhost";
$username = "root";
$password = "mob";
$dbname = "leaderboard";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $game = $_POST['game'];
    $score = $_POST['score'];
    if (empty($nick)) {
        $message = "Name is empty";
    } else {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO players (nick, game, score) VALUES (:nick, :game, :score)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nick', $nick);
            $stmt->bindParam(':game', $game);
            $stmt->bindParam(':score', $score);
            $stmt->execute();
            $message = "New record created successfully";
        } catch(PDOException $e) {
            $message = "Invalid input or system failure";
        }
    }
    header('Location: index.php?message=' . $message);
}