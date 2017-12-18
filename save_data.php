<?php

$servername = "localhost";
$username = "root";
$password = "mob";
$dbname = "leaderboard";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    if (empty($nick)) {
        $message = "Name is empty";
    } else {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO players (nick) VALUES (:nick)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nick', $nick);
            $stmt->execute();
            $message = "New record created successfully";
        } catch(PDOException $e) {
            $message = "Connection failed: " . $e->getMessage();
        }
    }
    header('Location: index.php?message=' . $message);
}