window.onload = function() {
    $("#top-scores").stupidtable();

    document.querySelector("#game-list").onchange = function() {
        var input, filter, table, tr, td, i;
        input = document.querySelector("#game-list");
        filter = input.value.toUpperCase();
        table = document.querySelector("tbody");
        tr = table.querySelectorAll("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
};