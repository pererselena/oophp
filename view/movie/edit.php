<?php namespace Anax\View;
?>

<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="id" value="<?= $resultset->id ?>"/>
    <br>

    <label>Title:</label><br>
    <input type="text" name="title" value="<?= $resultset->title ?>"/>
    <br>


    <label>Year:</label><br>
    <input type="number" name="year" value="<?= $resultset->year ?>"/>
    <br>


    <label>Image:</label><br>
    <input type="text" name="image" value="<?= $resultset->image ?>"/>
    <br>

    <p>
        <input class="buttons_input" type="submit" name="doSave" value="Save">
    </p>
    <br>
    <p>
        <a href="../movie">Show all</a>
    </p>
    </fieldset>
</form>
