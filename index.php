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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nick = $_POST['nick'];
            if (empty($nick)) {
                echo "Name is empty";
            } else {
                echo $nick;
            }
        }
    ?>

</body>
</html>