<?php
/**
 * Guess my number.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");



//Incoming variables.
$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? "";
$doGuess = $_POST["doGuess"] ?? "";
$doCheat = $_POST["doCheat"] ?? "";

if (isset($_SESSION["object"])) {
    $object = unserialize($_SESSION["object"]);
} else {
    $object = new Guess();
    $_SESSION["object"] = serialize($object);
}

$object->setInit($doInit);
$object->setGuess($doGuess);
$object->setCheat($doCheat);

if ($doInit === "Start from beginning") {
    $object = new Guess();
}

try {
    $res = $object->makeGuess((int)$guess);
} catch (GuessException $e) {
    $res = "not between 1 and 100";
}

$_SESSION["object"] = serialize($object);







// if ($doInit || $number === null) {
//     // Init the game.
//     $number = rand(1, 100);
//     $tries = 5;
// } elseif ($doGuess) {
//     // Do a guess.
//     $tries -= 1;
//     if ($guess === $number) {
//         $res = "CORRECT";
//     } elseif ($guess > $number) {
//         $res = "TOO HIGH";
//     } else {
//         $res = "TOO LOW";
//     }
// }


// Render the page.
require __DIR__ . "/view/guess_my_number.php";
