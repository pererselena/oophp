<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$dice = new \Elpr\Dice\DiceHand();
$dice->roll();
$sum = $dice->sum();
$currentScore = $current->currentScore;
$totalScore = $current->totalScore;
// $res = [];
// $class = [];
// for ($i = 0; $i < $rolls; $i++) {
//     $res[] = $dice->roll();
//     $class[] = $dice->graphic();
// }

?><main>
    <h1><?= $current->name ?> rolling dices</h1>

    <p>
    <?php foreach ($dice->getClassNames() as $value) : ?>
        <i class="dice-sprite <?= $value ?>"></i>
    <?php endforeach; ?>
    </p>

    <p><?= implode(", ", $dice->values()) ?></p>
    <form class="" action="play" method="post">
        <?php if ($sum == -1) : ?>
            <p>You lost all the score!!!</p>
            <input type="number" name="currentScore" value=0 hidden="true">
            <button type="submit" formaction="change">Change player</button>
        <?php else : ?>
            <p>Sum is: <?= $sum ?>.</p>
            <p>Current sum is: <?= $sum + $currentScore ?></p>
            <input type="number" name="currentScore" value=<?= $sum+$currentScore ?> hidden="true">
            <button type="submit" formaction="change">Save score</button>
            <button type="submit" formaction="play">Roll again</button>
        <?php endif; ?>
    </form>
    <p>Total score: <?= $totalScore ?></p>


</main>
