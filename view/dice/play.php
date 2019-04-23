<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$dice = new \Elpr\Dice\DiceGraphic();
$rolls = 6;
$res = [];
$class = [];
for ($i = 0; $i < $rolls; $i++) {
    $res[] = $dice->roll();
    $class[] = $dice->graphic();
}

?><main>
    <h1><?= $current->name ?> rolling <?= $rolls ?> graphic dices</h1>

    <p>
    <?php foreach ($class as $value) : ?>
        <i class="dice-sprite <?= $value ?>"></i>
    <?php endforeach; ?>
    </p>

    <p><?= implode(", ", $res) ?></p>
    <p>Sum is: <?= array_sum($res) ?>.</p>
    <p>Average is: <?= round(array_sum($res) / 6, 1) ?>.</p>

</main>
