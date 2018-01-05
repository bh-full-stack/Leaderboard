<h3 class="pull-left">Top Scores</h3>
<table class="table table-striped table-hover" id="top-scores">
    <thead>
    <tr>
        <th data-sort="string">Nick</th>
        <th data-sort="string">Game</th>
        <th data-sort="int">Score</th>
        <th data-sort="string">Country</th>
        <th data-sort="string">City</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($playersData as $playerData): ?>
        <tr>
            <td><?=$playerData["nick"]?></td>
            <td><?=$playerData["game"]?></td>
            <td><?=$playerData["score"]?></td>
            <td><?=$playerData["country"]?></td>
            <td><?=$playerData["city"]?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>