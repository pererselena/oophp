<?php namespace Anax\View;
?>

<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="id" value="<?= $resultset->id ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="title" value="<?= $resultset->title ?>"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="year" value="<?= $resultset->year ?>"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="image" value="<?= $resultset->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
    </p>
    <p>
        <a href="../movie">Show all</a>
    </p>
    </fieldset>
</form>
