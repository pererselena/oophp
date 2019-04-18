<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and resirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the game;
    $object = new Elpr\Guess\Guess();
    $_SESSION["object"] = serialize($object);

    return $app->response->redirect("guess/play");
});



/**
 * Play the game
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game!";
    $data = [
        "who" => "you ",
    ];

    $app->page->add("guess/play", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});
