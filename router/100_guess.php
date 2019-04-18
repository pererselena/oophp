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
 * Play the game - show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game!";

    //Incoming variables.
    // $guess = $_POST["guess"] ?? null;
    // $doInit = $_POST["doInit"] ?? "";
    // $doGuess = $_POST["doGuess"] ?? "";
    // $doCheat = $_POST["doCheat"] ?? "";
    $object = new Elpr\Guess\Guess();
    // $res = null;


    // if (isset($_SESSION["object"])) {
    //     $object = unserialize($_SESSION["object"]);
    // } else {
    //     $object = new Elpr\Guess\Guess();
    //     $_SESSION["object"] = serialize($object);
    // }

    $data = [
        "guess" => $guess ?? null,
        "tries" => $object->tries(),
        "number" => $object->number(),
        // "res" => $res,
        "object" => $object,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null
    ];

    $app->page->add("guess/play", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game - make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game!";

    //Incoming variables.
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? "";
    $doGuess = $_POST["doGuess"] ?? "";
    $doCheat = $_POST["doCheat"] ?? "";
    $object = new Elpr\Guess\Guess();



    if (isset($_SESSION["object"])) {
        $object = unserialize($_SESSION["object"]);
    } else {
        $object = new Elpr\Guess\Guess();
        $_SESSION["object"] = serialize($object);
    }

    return $app->response->redirect("guess/play");
});
