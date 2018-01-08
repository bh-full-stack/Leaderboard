<h3 class="pull-left">Top Scores</h3>
<table class="table table-striped table-hover">
    <thead>
    <tr class="table-header-row">
        <th class="nick">Nick</th>
        <th class="game">Game</th>
        <th class="score">Score</th>
        <th class="country">Country</th>
        <th class="city">City</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($playersData as $playerData): ?>
        <tr class="table-data-row">
            <td><?=$playerData["nick"]?></td>
            <td><?=$playerData["game"]?></td>
            <td><?=$playerData["score"]?></td>
            <td><?=$playerData["country"]?></td>
            <td><?=$playerData["city"]?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>