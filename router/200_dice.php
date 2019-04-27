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
    $game = new Elpr\Dice\Game();
    $app->session->set("game", $game);

    return $app->response->redirect("dice/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("dice/play", function () use ($app) {
    //Incoming variables.
    $title = "Play the game!";
    $game = $app->session->get("game");

    $haveWinner = $game->playRound();

    $data = [
        "game" => $game,
        "haveWinner" => $haveWinner
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
    $game = $app->session->get("game");
    //$game->currentScore = $score;
    $app->session->set("game", $game);

    return $app->response->redirect("dice/play");
});


/**
 * Change players
 */
$app->router->post("dice/change", function () use ($app) {
    //Incoming variables.
    //$score = $app->request->getPost("currentScore");
    $game = $app->session->get("game");
    //$game->currentScore = 0;
    //$game->totalScore += $score;
    $game->saveScore();
    $app->session->set("game", $next);

    return $app->response->redirect("dice/play");
});
