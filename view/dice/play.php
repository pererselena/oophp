<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
//$dice = new \Elpr\Dice\DiceHand();
// $dice->roll();
// $sum = $dice->sum();
$currentScore = $current->currentScore;
$totalScore = $current->totalScore;
// $res = [];
// $class = [];
// for ($i = 0; $i < $rolls; $i++) {
//     $res[] = $dice->roll();
//     $class[] = $dice->graphic();
// }

?><main>
    <?php if ($current->hasWon()): ?>
        <h1><?= $current->name ?> has won!!!</h1>
        <?php foreach ($current->getClassNames() as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        <p><?= implode(", ", $current->values()) ?></p>

        <p>Total score: <?= $totalScore + $currentScore ?></p>

        <form class="" action="init" method="get">
            <button type="submit" formaction="init">Play again</button>
        </form>
    <?php else : ?>
        <h1><?= $current->name ?> rolling dices</h1>

        <p>
        <?php foreach ($current->getClassNames() as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>

        <p><?= implode(", ", $current->values()) ?></p>
        <form class="" action="play" method="post">
            <?php if ($canPlayAgain) : ?>
                <p>Sum is: <?= $current->sum ?>.</p>
                <p>Current sum is: <?= $currentScore ?></p>
                <button type="submit" formaction="change">Save score</button>
                <button type="submit" formaction="play">Roll again</button>
            <?php else : ?>
                <p>You lost all the score!!!</p>
                <button type="submit" formaction="change">Change player</button>
            <?php endif; ?>
        </form>
        <p>Total score: <?= $totalScore ?></p>
    <?php endif; ?>


</main>
