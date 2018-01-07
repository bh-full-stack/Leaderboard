<h3 class="pull-left">Top Scores</h3>
<form class="form-inline pull-right" id="sort-by-form">
    Sort by:
    <select class="form-control" name="sort-by" id="sort-by-menu">
        <option value="nick"
            <?php if (!isset($_GET['sort-by']) ||
                (isset($_GET['sort-by']) && $_GET['sort-by'] == 'nick')) echo 'selected'; ?>>Nick</option>
        <option value="game"
            <?php if (isset($_GET['sort-by']) && $_GET['sort-by'] == 'game') echo 'selected'; ?>>Game</option>
        <option value="score"
            <?php if (isset($_GET['sort-by']) && $_GET['sort-by'] == 'score') echo 'selected'; ?>>Score</option>
    </select>
    <select class="form-control" name="sort-direction" id="sort-direction-menu">
        <option value="ASC"
            <?php if (!isset($_GET['sort-direction']) ||
                (isset($_GET['sort-direction']) && $_GET['sort-direction'] == 'ASC')) echo 'selected'; ?>>&uarr; Ascending</option>
        <option value="DESC"
            <?php if (isset($_GET['sort-direction']) && $_GET['sort-direction'] == 'DESC') echo 'selected'; ?>>&darr; Descending</option>
    </select>
</form>
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