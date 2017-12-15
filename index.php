<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
</head>
<body>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label>
            Name:
            <input type="text" name="nick">
        </label>
        <label>
            Male:
            <input type="radio" name="gender" value="male">
        </label>
        <label>
            Female:
            <input type="radio" name="gender" value="female">
        </label>
        <input type="submit">
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "mob";
    $dbname = "leaderboard";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nick = $_POST['nick'];
        if (empty($nick)) {
            echo "Name is empty";
        } else {
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO players (nick) VALUES (:nick)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nick', $nick);
                $stmt->execute();
                echo "New record created successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
    ?>

</body>
</html>