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
// $currentScore = $current->currentScore;
// $totalScore = $current->totalScore;
// $res = [];
// $class = [];
// for ($i = 0; $i < $rolls; $i++) {
//     $res[] = $dice->roll();
//     $class[] = $dice->graphic();
// }

$pCurrentScore = $game->player->currentScore;
$pTotalScore = $game->player->totalScore;
$cCurrentScore = $game->computer->currentScore;
$cTotalScore = $game->computer->totalScore;

?><main>
    <?php if (! $haveWinner): ?>
        <h1><?= $game->winner ?> has won!!!</h1>
        <p>Player score: <?= $pTotalScore + $pCurrentScore ?></p>
        <p>Computer score: <?= $cTotalScore + $cCurrentScore ?></p>

        <form class="" action="init" method="get">
            <button type="submit" formaction="init">Play again</button>
        </form>
    <?php else : ?>
        <h1>Rolling dices</h1>
        <h2>Player rolls</h2>
        <p>
        <?php foreach ($game->player->getClassNames() as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>

        <p><?= implode(", ", $game->player->values()) ?></p>
        <form class="" action="play" method="post">
            <?php if ($game->player->sum != -1) : ?>
                <p>Sum is: <?= $game->player->sum ?>.</p>
                <p>Current sum is: <?= $pCurrentScore ?></p>
                <button type="submit" formaction="change">Save score</button>
                <button type="submit" formaction="play">Roll again</button>
            <?php else : ?>
                <p>You lost all the score!!!</p>
                <button type="submit" formaction="change">Roll again</button>
            <?php endif; ?>
        </form>
        <p>Total score: <?= $pTotalScore ?></p>


        <h2>Computer rolls</h2>
        <p>
        <?php foreach ($game->computer->getClassNames() as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>

        <p><?= implode(", ", $game->computer->values()) ?></p>
        <form class="" action="play" method="post">

            <?php if ($game->computer->sum != -1) : ?>
                <p>Sum is: <?= $game->computer->sum ?>.</p>
                <p>Current sum is: <?= $cCurrentScore ?></p>
            <?php else : ?>
                <p>Computer lost all the score!!!</p>
            <?php endif; ?>
        </form>
        <p>Total score: <?= $cTotalScore ?></p>
    <?php endif; ?>



</main>
