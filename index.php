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
            <input type="text" name="nick" required>
        </label>
        <label>
            Score:
            <input type="number" name="score" min="0" max="65535" required>
        </label>
        <label>
            Game:
            <select name="game" required>
                <option disabled selected value></option>
                <option value="Tetris">Tetris</option>
                <option value="Mario">Mario</option>
            </select>
        </label>
        <input type="submit">
    </form>
    <div>
        <?php echo $_GET["message"]; ?>
    </div>
</body>
</html>