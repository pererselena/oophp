<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and resirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the game;
    $playerOne = new Elpr\Dice\Player("Player 1");
    $playerTwo = new Elpr\Dice\Player("Computer");
    $app->session->set("current", $playerOne);
    $app->session->set("next", $playerTwo);

    return $app->response->redirect("dice/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("dice/play", function () use ($app) {
    //Incoming variables.
    $title = "Play the game!";
    $current = $app->session->get("current");
    $next = $app->session->get("next");

    $current->throwDice();
    $data = [
        "current" => $current,
        "next" => $next
    ];

    $app->page->add("dice/play", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game - make a guess
 */
$app->router->post("dice/play", function () use ($app) {
    //Incoming variables.
    //$score = $app->request->getPost("currentScore");
    $current = $app->session->get("current");
    //$current->currentScore = $score;
    $app->session->set("current", $current);

    return $app->response->redirect("dice/play");
});


/**
 * Change players
 */
$app->router->post("dice/change", function () use ($app) {
    //Incoming variables.
    //$score = $app->request->getPost("currentScore");
    $current = $app->session->get("current");
    $next = $app->session->get("next");
    //$current->currentScore = 0;
    //$current->totalScore += $score;
    $current->saveScore();
    $app->session->set("next", $current);
    $app->session->set("current", $next);

    return $app->response->redirect("dice/play");
});
