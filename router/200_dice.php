<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and resirect to play the game.
 */
$app->router->get("dice1/init", function () use ($app) {
    // Init the game;
    $game = new Elpr\Dice\Game();
    $app->session->set("game", $game);

    return $app->response->redirect("dice/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("dice1/play", function () use ($app) {
    //Incoming variables.
    $title = "Play the game!";
    $game = $app->session->get("game");

    $haveWinner = $game->playRound("roll");

    $data = [
        "game" => $game,
        "haveWinner" => $haveWinner
    ];

    $app->page->add("dice1/play", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game - make a guess
 */
$app->router->post("dice1/play", function () use ($app) {
    //Incoming variables.
    //$score = $app->request->getPost("currentScore");
    $game = $app->session->get("game");
    //$game->currentScore = $score;
    $app->session->set("game", $game);

    return $app->response->redirect("dice1/play");
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
    $game->playRound("");
    $app->session->set("game", $game);

    return $app->response->redirect("dice/play");
});
