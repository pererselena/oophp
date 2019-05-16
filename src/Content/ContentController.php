<?php

namespace Elpr\Content;

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
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $content;



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->content = new Content($this->app->db);

        // Use $this->app to access the framework services.
    }



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
        $title = "Content database | oophp";

        $resultset = $this->content->getAllPost();

        $this->app->page->add("content/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the create method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object as page
     */
    public function createAction() : object
    {
        $title = "Create content | oophp";

        $this->app->page->add("content/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object as page
     */
    // public function resetAction() : object
    // {
    //     $title = "Resetting the database | oophp";
    //
    //     $this->app->page->add("content/reset");
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object as page
     */
    // public function adminAction() : object
    // {
    //     $title = "Admin content | oophp";
    //
    //     $this->app->db->connect();
    //     $sql = "SELECT * FROM kmom06_content;";
    //     $resultset = $this->app->db->executeFetchAll($sql);
    //
    //     $this->app->page->add("content/admin", [
    //         "resultset" => $resultset,
    //     ]);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    //
    // /**
    //  * Search by title
    //  *
    //  *
    //  * @return object As page
    //  */
    // public function searchTitleActionGet() : object
    // {
    //     $title = "Serch movies | oophp";
    //
    //     $searchTitle = $this->app->session->get("searchTitle");
    //     $resultset = $this->app->session->get("resultset");
    //     $this->app->session->set("resultset", null);
    //
    //     $this->app->page->add("movie/search-title", [
    //         "resultset" => $resultset,
    //         "searchTitle" => $searchTitle,
    //     ]);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    // /**
    //  * Search by title
    //  *
    //  *
    //  * @return object AS page
    //  */
    // public function editActionPost() : object
    // {
    //     $this->app->db->connect();
    //     $contentId = $this->app->request->getPost("contentId");
    //     if (!is_numeric($contentId)) {
    //         die("Not valid for content id.");
    //     }
    //
    //     if (hasKeyPost("doDelete")) {
    //         header("Location: ?route=delete&id=$contentId");
    //         exit;
    //     } elseif (hasKeyPost("doSave")) {
    //         $params = getPost([
    //             "contentTitle",
    //             "contentPath",
    //             "contentSlug",
    //             "contentData",
    //             "contentType",
    //             "contentFilter",
    //             "contentPublish",
    //             "contentId"
    //         ]);
    //
    //         if (!$params["contentSlug"]) {
    //             $params["contentSlug"] = slugify($params["contentTitle"]);
    //         }
    //
    //         if (!$params["contentPath"]) {
    //             $params["contentPath"] = null;
    //         }
    //
    //         $sql = "UPDATE kmom06_content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
    //         $db->execute($sql, array_values($params));
    //         header("Location: ?route=edit&id=$contentId");
    //         exit;
    //     }
    //
    //     $sql = "SELECT * FROM kmom06_content WHERE id = ?;";
    //     $content = $db->executeFetch($sql, [$contentId]);
    //             //$doSearch = $this->app->request->getPost("doSearch");
    //             $sql = "SELECT * FROM kmom05_movie WHERE title LIKE ?;";
    //             $resultset = $this->app->db->executeFetchAll($sql, ["%" . $searchTitle . "%"]);
    //
    //             $this->app->session->set("resultset", $resultset);
    //
    //             return $this->app->response->redirect("movie/search-title");
    // }
    //
    // /**
    //  * Search by year
    //  *
    //  *
    //  * @return object As page
    //  */
    // public function searchYearActionGet() : object
    // {
    //     $title = "Serch movies | oophp";
    //
    //
    //     $resultset = $this->app->session->get("resultset");
    //     $this->app->session->set("resultset", null);
    //
    //     $this->app->page->add("movie/search-year", [
    //         "resultset" => $resultset,
    //     ]);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    // /**
    //  * Search by year
    //  *
    //  *
    //  * @return object AS page
    //  */
    // public function searchYearActionPost() : object
    // {
    //     $this->app->db->connect();
    //     $year1 = $this->app->request->getPost("year1");
    //     $year2 = $this->app->request->getPost("year2");
    //
    //     if ($year1 && $year2) {
    //         $sql = "SELECT * FROM kmom05_movie WHERE year >= ? AND year <= ?;";
    //         $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
    //     } elseif ($year1) {
    //         $sql = "SELECT * FROM kmom05_movie WHERE year >= ?;";
    //         $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
    //     } elseif ($year2) {
    //         $sql = "SELECT * FROM kmom05_movie WHERE year <= ?;";
    //         $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
    //     }
    //
    //     $this->app->session->set("resultset", $resultset);
    //
    //     return $this->app->response->redirect("movie/search-year");
    // }
    // /**
    //  * Edit movie
    //  *
    //  *
    //  * @return object As page
    //  */
    // public function editActionGet() : object
    // {
    //     $title = "Edit movies | oophp";
    //
    //     $movieId = $this->app->request->getGet("movieId");
    //     $sql = "SELECT * FROM kmom05_movie WHERE id = ?;";
    //     $this->app->db->connect();
    //     $res = $this->app->db->executeFetch($sql, [$movieId]);
    //
    //     $this->app->page->add("movie/edit", [
    //         "resultset" => $res,
    //     ]);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    // /**
    //  * Edit movie
    //  *
    //  *
    //  * @return object AS page
    //  */
    // public function editActionPost() : object
    // {
    //     $this->app->db->connect();
    //     $year = $this->app->request->getPost("year");
    //     $title = $this->app->request->getPost("title");
    //     $image = $this->app->request->getPost("image");
    //     $id = $this->app->request->getPost("id");
    //
    //     $sql = "UPDATE kmom05_movie SET title = ?, year = ?, image = ? WHERE id = ?;";
    //     $this->app->db->execute($sql, [$title, $year, $image, $id]);
    //
    //
    //     return $this->app->response->redirect("movie");
    // }
    // /**
    //  * Delete movie
    //  *
    //  *
    //  * @return object As page
    //  */
    // public function deleteActionGet() : object
    // {
    //     $title = "Delete movies | oophp";
    //
    //     $movieId = $this->app->request->getGet("movieId");
    //     $sql = "SELECT * FROM kmom05_movie WHERE id = ?;";
    //     $this->app->db->connect();
    //     $res = $this->app->db->executeFetch($sql, [$movieId]);
    //
    //     $this->app->page->add("movie/delete", [
    //         "resultset" => $res,
    //     ]);
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    // /**
    //  * Delete movie
    //  *
    //  *
    //  * @return object AS page
    //  */
    // public function deleteActionPost() : object
    // {
    //     $movieId = $this->app->request->getGet("movieId");
    //
    //     $this->app->db->connect();
    //     $sql = "DELETE FROM kmom05_movie WHERE id = ?;";
    //
    //     $this->app->db->execute($sql, [$movieId]);
    //
    //
    //     return $this->app->response->redirect("movie");
    // }
    // /**
    //  * Add movie
    //  *
    //  *
    //  * @return object As page
    //  */
    // public function addActionGet() : object
    // {
    //     $title = "Add movies | oophp";
    //
    //     $this->app->page->add("movie/add");
    //
    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    // /**
    //  * Add movie
    //  *
    //  *
    //  * @return object AS page
    //  */
    // public function addActionPost() : object
    // {
    //     $this->app->db->connect();
    //     $year = $this->app->request->getPost("year");
    //     $title = $this->app->request->getPost("title");
    //     $image = $this->app->request->getPost("image");
    //
    //     $sql = "INSERT INTO kmom05_movie (title, year, image) VALUES (?, ?, ?);";
    //     $this->app->db->execute($sql, [$title, $year, $image]);
    //
    //
    //     return $this->app->response->redirect("movie");
    // }
}
