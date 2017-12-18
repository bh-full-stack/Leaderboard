<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
</head>
<body>
    <form method="POST" action="save_data.php">
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
    <div>
        <?php echo $_GET["message"]; ?>
    </div>
</body>
</html>