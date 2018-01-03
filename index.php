<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
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

<div class="container text-center">
    <h3>Leaderboard</h3>
    <p><em>We love music!</em></p>
    <p>We have created a fictional band website. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <p class="text-center"><strong>Name</strong></p><br>
            <a href="#demo" data-toggle="collapse">
                <img src="bandmember.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
            </a>
            <div id="demo" class="collapse">
                <p>Guitarist and Lead Vocalist</p>
                <p>Loves long walks on the beach</p>
                <p>Member since 1988</p>
            </div>
        </div>
        <div class="col-sm-4">
            <p class="text-center"><strong>Name</strong></p><br>
            <a href="#demo2" data-toggle="collapse">
                <img src="bandmember.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
            </a>
            <div id="demo2" class="collapse">
                <p>Drummer</p>
                <p>Loves drummin'</p>
                <p>Member since 1988</p>
            </div>
        </div>
        <div class="col-sm-4">
            <p class="text-center"><strong>Name</strong></p><br>
            <a href="#demo3" data-toggle="collapse">
                <img src="bandmember.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
            </a>
            <div id="demo3" class="collapse">
                <p>Bass player</p>
                <p>Loves math</p>
                <p>Member since 2005</p>
            </div>
        </div>
    </div>
</div>

<footer class="text-center">
    <a class="up-arrow" href="#topScores" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
</footer>

</body>
</html>