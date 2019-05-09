<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));
$request = new \Anax\Request\Request();


/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM kmom05_movie;";
    $resultset = $app->db->executeFetchAll($sql);

    $app->page->add("movie/index", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Search by title.
 */

$app->router->get("movie/search-title", function () use ($app) {
    $title = "Serch movies | oophp";

    $searchTitle = $app->session->get("searchTitle");
    $resultset = $app->session->get("resultset");
    $app->session->set("resultset", null);

    $app->page->add("movie/search-title", [
        "resultset" => $resultset,
        "searchTitle" => $searchTitle,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/search-title", function () use ($app) {

    $app->db->connect();
    $searchTitle = $app->request->getPost("searchTitle");
    //$doSearch = $app->request->getPost("doSearch");
    $sql = "SELECT * FROM kmom05_movie WHERE title LIKE ?;";
    $resultset = $app->db->executeFetchAll($sql, ["%" . $searchTitle . "%"]);

    $app->session->set("resultset", $resultset);

    return $app->response->redirect("movie/search-title");
});


/**
 * Search by year.
 */

$app->router->get("movie/search-year", function () use ($app) {
    $title = "Serch movies | oophp";


    $resultset = $app->session->get("resultset");
    $app->session->set("resultset", null);

    $app->page->add("movie/search-year", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/search-year", function () use ($app) {

    $app->db->connect();
    $year1 = $app->request->getPost("year1");
    $year2 = $app->request->getPost("year2");

    if ($year1 && $year2) {
        $sql = "SELECT * FROM kmom05_movie WHERE year >= ? AND year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1, $year2]);
    } elseif ($year1) {
        $sql = "SELECT * FROM kmom05_movie WHERE year >= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1]);
    } elseif ($year2) {
        $sql = "SELECT * FROM kmom05_movie WHERE year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year2]);
    }

    $app->session->set("resultset", $resultset);

    return $app->response->redirect("movie/search-year");
});
