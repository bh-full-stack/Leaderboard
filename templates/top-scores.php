<h3 class="pull-left">Top Scores</h3>
<select class="form-control pull-right" id="game-list">
    <option value="">All</option>
    <?php foreach ($listOfGames as $game): ?>
        <option><?=$game?></option>
    <?php endforeach; ?>
</select>

<table class="table table-hover" id="top-scores">
    <thead>
    <tr>
        <th data-sort="string">Nick</th>
        <th data-sort="string">Game</th>
        <th data-sort="int">Top score</th>
        <th data-sort="int">Number of rounds</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($playersData as $playerData): ?>
        <tr>
            <td><?=$playerData["nick"]?></td>
            <td><?=$playerData["game"]?></td>
            <td><?=$playerData["top_score"]?></td>
            <td><?=$playerData["number_of_rounds"]?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>