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
     * Play the game - show game status.:
     *
     *
     * @return object As page
     */
    public function searchYearActionGet() : object
    {
        $title = "Serch movies | oophp";


        $resultset = $this->app->session->get("resultset");
        $this->app->session->set("resultset", null);

        $this->app->page->add("movie/search-year", [
            "resultset" => $resultset,
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
    public function searchYearActionPost() : object
    {
        $this->app->db->connect();
        $year1 = $this->app->request->getPost("year1");
        $year2 = $this->app->request->getPost("year2");

        if ($year1 && $year2) {
            $sql = "SELECT * FROM kmom05_movie WHERE year >= ? AND year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM kmom05_movie WHERE year >= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM kmom05_movie WHERE year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
        }

        $this->app->session->set("resultset", $resultset);

        return $this->app->response->redirect("movie/search-year");
    }
    /**
     * Play the game - show game status.:
     *
     *
     * @return object As page
     */
    public function editActionGet() : object
    {
        $title = "Edit movies | oophp";

        $movieId = $this->app->request->getGet("movieId");
        $sql = "SELECT * FROM kmom05_movie WHERE id = ?;";
        $this->app->db->connect();
        $res = $this->app->db->executeFetch($sql, [$movieId]);

        $this->app->page->add("movie/edit", [
            "resultset" => $res,
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
    public function editActionPost() : object
    {
        $this->app->db->connect();
        $year = $this->app->request->getPost("year");
        $title = $this->app->request->getPost("title");
        $image = $this->app->request->getPost("image");
        $id = $this->app->request->getPost("id");

        $sql = "UPDATE kmom05_movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $this->app->db->execute($sql, [$title, $year, $image, $id]);


        return $this->app->response->redirect("movie");
    }
    /**
     * Play the game - show game status.:
     *
     *
     * @return object As page
     */
    public function deleteActionGet() : object
    {
        $title = "Delete movies | oophp";

        $movieId = $this->app->request->getGet("movieId");
        $sql = "SELECT * FROM kmom05_movie WHERE id = ?;";
        $this->app->db->connect();
        $res = $this->app->db->executeFetch($sql, [$movieId]);

        $this->app->page->add("movie/delete", [
            "resultset" => $res,
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
    public function deleteActionPost() : object
    {
        $movieId = $this->app->request->getGet("movieId");

        $this->app->db->connect();
        $id = $this->app->request->getPost("id");
        $sql = "DELETE FROM kmom05_movie WHERE id = ?;";

        $this->app->db->execute($sql, [$movieId]);


        return $this->app->response->redirect("movie");
    }
}
