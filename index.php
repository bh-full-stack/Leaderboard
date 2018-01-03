<?php
require "model/Player.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Leaderboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body id="topScores" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#topScores">Leaderboard</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#topScores">Top Scores</a></li>
                <li><a href="#signUp">Sign Up</a></li>
                <li><a href="#signIn">Sign In</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h3>Top Scores</h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nick</th>
                <th>Game</th>
                <th>Score</th>
                <th>Country</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach (Player::list() as $playerData):
        ?>
            <tr>
                <td><?=$playerData["nick"]?></td>
                <td><?=$playerData["game"]?></td>
                <td><?=$playerData["score"]?></td>
                <td><?=$playerData["country"]?></td>
                <td><?=$playerData["city"]?></td>
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>
</div>

<footer class="text-center">
    <a class="up-arrow" href="#topScores" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
</footer>

</body>
</html>