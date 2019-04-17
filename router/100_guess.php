<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and resirect to play the game.
 */
$app->router->get("guess1/init", function () use ($app) {
    // echo "Init the session for the game start";
    return $app->response->redirect("guess1/play");
});



/**
 * Play the game
 */
$app->router->get("guess1/play", function () use ($app) {
    $title = "Play the game!";
    $data = [
        "class" => "hello-world",
        "content" => "Hello World in " . __FILE__,
    ];

    $app->page->add("guess1/play", $data);
    $app->page->add("guess1/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Showing message Hello World, rendered within the standard page layout.
 */
$app->router->get("lek/hello-world-page", function () use ($app) {
    $title = "Hello World as a page";
    $data = [
        "class" => "hello-world",
        "content" => "Hello World in " . __FILE__,
    ];

    $app->page->add("anax/v2/article/default", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
