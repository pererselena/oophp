<?php namespace Anax\View;
?>

<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <br>
    <label>Title:</label><br>
    <input type="text" name="title"/>
    <br>
    <label>Year:</label><br>
    <input type="number" name="year"/>
    <br>
    <label>Image:</label><br>
    <input type="text" name="image"/>
    <br>
    <input type="submit" name="doAdd" value="Add"><br>

    <p>
        <a href="../movie">Show all</a>
    </p>
    </fieldset>
</form>
