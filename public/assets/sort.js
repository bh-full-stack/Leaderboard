window.onload = function () {

    var nickDirection, scoreDirection, gameDirection, cityDirection, countryDirection, sortBy, sortDirection;
    var nickClickCounter = 1;
    var gameClickCounter = 1;
    var cityClickCounter = 1;
    var countryClickCounter = 1;
    var scoreClickCounter = 2;

    $(document).on("click", ".table-header", function (event) {

        sortBy = event.target.className;

        nickClickCounter % 2 !== 0 ? nickDirection = "ASC" : nickDirection = "DESC";
        gameClickCounter % 2 !== 0 ? gameDirection = "ASC" : gameDirection = "DESC";
        cityClickCounter % 2 !== 0 ? cityDirection = "ASC" : cityDirection = "DESC";
        countryClickCounter % 2 !== 0 ? countryDirection = "ASC" : countryDirection = "DESC";
        scoreClickCounter % 2 !== 0 ? scoreDirection = "ASC" : scoreDirection = "DESC";

        switch (sortBy) {
            case "nick":
                sortDirection = nickDirection;
                nickClickCounter++;
                break;
            case "game":
                sortDirection = gameDirection;
                gameClickCounter++;
                break;
            case "city":
                sortDirection = cityDirection;
                cityClickCounter++;
                break;
            case "country":
                sortDirection = countryDirection;
                countryClickCounter++;
                break;
            case "score":
                sortDirection = scoreDirection;
                scoreClickCounter++;
                break;
        }

        $.get(
            "http://leaderboard.local",
            {
                by: sortBy,
                direction: sortDirection
            },
            function (response) {
                document.querySelector(".container").innerHTML = response;
            });

    });
};