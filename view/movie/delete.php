<?php namespace Anax\View;

?>

<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <label>Id:</label><br>
    <input disabled name="id" value="<?= $resultset->id ?>"/>
    <br>
    <label>Title:</label><br>
    <input disabled type="text" name="title" value="<?= $resultset->title ?>"/>
    <br>
    <label>Year:</label><br>
    <input disabled type="number" name="year" value="<?= $resultset->year ?>"/>
    <br>
    <label>Image:</label><br>
    <input disabled type="text" name="image" value="<?= $resultset->image ?>"/>
    <br>
    <p>
        <input class="buttons_input" type="submit" name="doDelete" value="Delete"><br>
    </p>

    <p>
        <a href="../movie">Show all</a>
    </p>
    </fieldset>
</form>
