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