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
    $object = new Elpr\Dice\Dice();
    $_SESSION["object"] = serialize($object);

    return $app->response->redirect("dice/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game!";

    //Incoming variables.
    $guess = $_SESSION["guess"] ?? null;
    $doInit = $_SESSION["doInit"] ?? "";
    $doGuess = $_SESSION["doGuess"] ?? "";
    $doCheat = $_SESSION["doCheat"] ?? "";
    $res = $_SESSION["res"] ?? "";

    if (isset($_SESSION["object"])) {
        $object = unserialize($_SESSION["object"]);
    } else {
        $object = new Elpr\Guess\Guess();
        $_SESSION["object"] = serialize($object);
    }

    $data = [
        "guess" => $guess ?? null,
        "tries" => $object->tries(),
        "number" => $object->number(),
        "res" => $res,
        "object" => $object,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null
    ];
    $_SESSION["object"] = serialize($object);

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
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? "";
    $doGuess = $_POST["doGuess"] ?? "";
    $doCheat = $_POST["doCheat"] ?? "";

    $_SESSION["doCheat"] = $doCheat;
    $_SESSION["doInit"] = $doInit;
    $_SESSION["doGuess"] = $doGuess;



    if (isset($_SESSION["object"])) {
        $object = unserialize($_SESSION["object"]);
    } else {
        $object = new Elpr\Dice\Dice();
        $_SESSION["object"] = serialize($object);
    }

    $object->setInit($doInit);
    $object->setGuess($doGuess);
    $object->setCheat($doCheat);

    if ($doInit === "Start from beginning") {
        $object = new Elpr\Dice\Dice();
    }

    if ($doGuess) {
        try {
            $res = $object->makeGuess((int)$guess);
        } catch (Elpr\Dice\DiceException $e) {
            $res = "not between 1 and 100";
        }
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    }
    $_SESSION["object"] = serialize($object);

    return $app->response->redirect("dice/play");
});
