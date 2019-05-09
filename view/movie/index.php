<?php
namespace Anax\View;


if (!$resultset) {
    return;
}
?>
<p>
    <a href="movie/search-title">Search by movie title</a>|
    <a href="movie/search-year">Search movies by year</a>|
    <a href="movie/add">Add movie</a>
</p>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th></th>
        <th></th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td><a href="<?= url("movie/edit?movieId=" . $row->id) ?>">Edit</a></td>
        <td><a href="<?= url("movie/delete?movieId=" . $row->id) ?>">Delete</a></td>
    </tr>
<?php endforeach; ?>
</table>
