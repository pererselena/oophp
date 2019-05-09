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
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/index", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Search title.
 */

$app->router->get("movie/search-title", function () use ($app) {
    $title = "SELECT * WHERE title";

    $app->db->connect();
    $searchTitle = $app->request->getGet("searchTitle");
    $doSearch = $app->request->getGet("doSearch");
    // if ($searchTitle) {
        $sql = "SELECT * FROM kmom05_movie WHERE title LIKE ?;";
        $resultset = $app->db->executeFetchAll($sql, ["%" . $searchTitle . "%"]);
    // }


    $app->page->add("movie/search-title", [
        "resultset" => $resultset,
        "searchTitle" => $searchTitle,
        "doSearch" => $doSearch,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
