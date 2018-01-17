<!DOCTYPE html>
<html lang="en">
<head>
    <title>Leaderboard</title>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/stupid-table-plugin/stupidtable.min.js"></script>
    <script src="assets/script.js"></script>
</head>

<body id="topScores">
@include('navigation')

<div class="container">
    @yield('content')
</div>

<footer class="text-center">
    <a class="up-arrow" href="#topScores" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
</footer>
</body>
</html>