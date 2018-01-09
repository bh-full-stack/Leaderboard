<h3 class="pull-left">Top Scores</h3>
<form class="form-inline pull-right" id="sort-by-form">
    Sort by:
    <select class="form-control" name="sort-by" id="sort-by-menu">
        <?php foreach ($playerAttributeNames as $optValue): ?>
        <option value="<?=$optValue?>"
            <?php if (isset($_GET['sort-by']) && $_GET['sort-by'] == $optValue) echo 'selected'; ?>>
            <?=ucfirst($optValue)?>
        </option>
        <?php endforeach;?>
    </select>
    <select class="form-control" name="sort-dir" id="sort-dir-menu">
        <option value="ASC"
            <?php if (!isset($_GET['sort-dir']) || $_GET['sort-dir'] == 'ASC') echo 'selected'; ?>>
            &uarr; Ascending
        </option>
        <option value="DESC"
            <?php if (isset($_GET['sort-dir']) && $_GET['sort-dir'] == 'DESC') echo 'selected'; ?>>
            &darr; Descending
        </option>
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