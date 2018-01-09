window.onload = function () {

    var sortBy;
    var directions = {
        nick: "DESC",
        game: "DESC",
        city: "DESC",
        country: "DESC",
        score: "ASC"
    };

    $(document).on("click", ".table-header-row", function (event) {

        sortBy = event.target.className;
        directions[sortBy] = (directions[sortBy] === "ASC" ? "DESC" : "ASC");

        $.get(
            "http://leaderboard.local/scores",
            {
                by: sortBy,
                direction: directions[sortBy]
            },
            function (response) {

                var tableData = JSON.parse(response);
                var tableLength = tableData.length;
                var columnMapping = ["nick", "game", "score", "country", "city"];
                var columnLength = columnMapping.length;
                var tableBody = document.querySelector("tbody");

                $(".table-data-row").remove();

                for (var i = 0; i < tableLength; i++){
                    var tableRow = tableBody.insertRow();
                    tableRow.classList.add("table-data-row");
                    for (var j = 0; j < columnLength; j++){
                        var tableCell = tableRow.insertCell();
                        var column = columnMapping[j];
                        tableCell.textContent(tableData[i][column]);
                    }
                }
            });
    });
};