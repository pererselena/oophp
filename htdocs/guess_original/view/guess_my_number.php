<!DOCTYPE html>
<html lang="sv" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Guess my number</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <main>
            <h1>Guess my number</h1>
            <p>Guess a number between 1 and 100, you have <?= $object->tries() ?> left.</p>

            <form method="post">
                <?php if ($object->tries() > 0) : ?>
                    <input type="number" name="guess"><br>
                    <input class="buttons_input" type="submit" name="doGuess" value="Make a guess">
                    <input class="buttons_input" type="submit" name="doInit" value="Start from beginning">
                    <input class="buttons_input" type="submit" name="doCheat" value="Cheat">
                <?php endif; ?>

            </form>

            <?php if ($doGuess) : ?>
                <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
            <?php endif; ?>

            <?php if ($doCheat) : ?>
                <p>CHEAT: Current number is <b><?= $object->number() ?></b></p>
            <?php endif; ?>
        </main>
    </body>
</html>
