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
    <?php if ($sum == -1) : ?>
        <p>You lost all the score!!!</p>
    <?php else : ?>
        <p>Sum is: <?= $sum ?>.</p>
    <?php endif; ?>


</main>
