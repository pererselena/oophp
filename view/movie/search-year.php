<?php namespace Anax\View;

?>

<form method="post">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-year">

    <label>Created between:
    <input type="number" name="year1" min="1900" max="2100"/>
    -
    <input type="number" name="year2" min="1900" max="2100"/>
    </label><br>

    <p>
        <input class="buttons_input" type="submit" name="doSearch" value="Search">
    </p>

    <p><a href="../movie">Show all</a></p>
    </fieldset>
</form>
<?php if ($resultset) : ?>
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
