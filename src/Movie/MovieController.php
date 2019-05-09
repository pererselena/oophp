<?php

namespace Elpr\Movie;

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
class MovieController implements AppInjectableInterface
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
     * @return object as page
     */
    public function indexAction() : object
    {
        $title = "Movie database | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM kmom05_movie;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * Play the game - show game status.:
     *
     *
     * @return object As page
     */
    public function searchTitleActionGet() : object
    {
        $title = "Serch movies | oophp";

        $searchTitle = $this->app->session->get("searchTitle");
        $resultset = $this->app->session->get("resultset");
        $this->app->session->set("resultset", null);

        $this->app->page->add("movie/search-title", [
            "resultset" => $resultset,
            "searchTitle" => $searchTitle,
        ]);

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
    public function searchTitleActionPost() : object
    {
        $this->app->db->connect();
        $searchTitle = $this->app->request->getPost("searchTitle");
        //$doSearch = $this->app->request->getPost("doSearch");
        $sql = "SELECT * FROM kmom05_movie WHERE title LIKE ?;";
        $resultset = $this->app->db->executeFetchAll($sql, ["%" . $searchTitle . "%"]);

        $this->app->session->set("resultset", $resultset);

        return $this->app->response->redirect("movie/search-title");
    }

    /**
     * Change players.:
     *
     *
     * @return object as response
     */
    public function changeActionPost() : object
    {
        $game = $this->app->session->get("game");
        $game->playRound("");
        $this->app->session->set("game", $game);

        return $this->app->response->redirect("dice/play");
    }
}
