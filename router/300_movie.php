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
 * Search title.
 */

$app->router->get("movie/search-title", function () use ($app) {
    $title = "Serch movies | oophp";

    $searchTitle = $app->session->get("searchTitle");
    //$doSearch = $app->session->get("doSearch");
    $resultset = $app->session->get("resultset");
    $app->session->set("resultset", null);

    $app->page->add("movie/search-title", [
        "resultset" => $resultset,
        "searchTitle" => $searchTitle,
        //"doSearch" => $doSearch,
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
        //die();
    // $app->page->add("movie/search-title", [
    //     "resultset" => $resultset,
    //     "searchTitle" => $searchTitle,
    //     "doSearch" => $doSearch,
    // ]);
    //
    // return $app->page->render([
    //     "title" => $title,
    // ]);
    return $app->response->redirect("movie/search-title");
});
