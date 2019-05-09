<?php namespace Anax\View;
?>

<form method="post">
    <fieldset>
    <legend>Search</legend>
    <label>Title (use % as wildcard):</label>
    <input type="text" name="searchTitle" value="<?= $searchTitle ?>"/>

    <input type="submit" name="doSearch" value="Search">

    <p><a href="../movie">Show all</a></p>
    </fieldset>
</form>
<?php if($resultset): ?>
    <table>
        <tr class="first">
            <th>Rad</th>
            <th>Id</th>
            <th>Bild</th>
            <th>Titel</th>
            <th>År</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++; ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $row->id ?></td>
            <td><img class="thumb" src="../<?= $row->image ?>"></td>
            <td><?= $row->title ?></td>
            <td><?= $row->year ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif ?>
