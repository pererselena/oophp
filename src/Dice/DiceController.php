<?php

namespace Elpr\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index!";
    }

    /**
     * Init the game and resirect to play the game.:
     *
     * @return object as a response
     */
    public function initAction() : object
    {
        $game = new Game();
        $this->app->session->set("game", $game);

        return $this->app->response->redirect("dice1/play");
    }

    /**
     * Play the game - show game status.:
     *
     *
     * @return object As page
     */
    public function playAction() : object
    {
        $title = "Play the game!";
        $game = $this->app->session->get("game");

        $haveWinner = $game->playRound("roll");

        $data = [
            "game" => $game,
            "haveWinner" => $haveWinner
        ];

        $this->app->page->add("dice1/play", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Play the game - make a guess.:
     *
     *
     * @return object AS page
     */
    public function playActionPost() : object
    {
        $title = "Play the game!";
        $game = $this->app->session->get("game");

        $haveWinner = $game->playRound("roll");

        $data = [
            "game" => $game,
            "haveWinner" => $haveWinner
        ];

        $this->app->page->add("dice1/play", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Change players.:
     *
     *
     * @return object as response
     */
    public function ChangeActionPost() : object
    {
        $game = $this->app->session->get("game");
        $game->playRound("");
        $this->app->session->set("game", $game);

        return $this->app->response->redirect("dice1/play");
    }




}