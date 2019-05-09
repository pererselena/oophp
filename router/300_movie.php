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






// $movieId = getPost("movieId");
//
// if (getPost("doDelete")) {
//     $sql = "DELETE FROM movie WHERE id = ?;";
//     $db->execute($sql, [$movieId]);
//     header("Location: ?route=movie-select");
//     exit;
// } elseif (getPost("doAdd")) {
//     $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
//     $db->execute($sql, ["A title", 2017, "img/noimage.png"]);
//     $movieId = $db->lastInsertId();
//     header("Location: ?route=movie-edit&movieId=$movieId");
//     exit;
// } elseif (getPost("doEdit") && is_numeric($movieId)) {
//     header("Location: ?route=movie-edit&movieId=$movieId");
//     exit;
// }
//
// $title = "Select a movie";
// $view[] = "view/movie-select.php";
// $sql = "SELECT id, title FROM movie;";
// $movies = $db->executeFetchAll($sql);
//

/**
 * CRUD - edit.
 */

$app->router->get("movie/edit", function () use ($app) {
    $title = "Edit movies | oophp";

    $movieId = $app->request->getGet("movieId");
    $sql = "SELECT * FROM kmom05_movie WHERE id = ?;";
    $app->db->connect();
    $res = $app->db->executeFetch($sql, [$movieId]);

    $app->page->add("movie/edit", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/edit", function () use ($app) {

    $app->db->connect();
    $year = $app->request->getPost("year");
    $title = $app->request->getPost("title");
    $image = $app->request->getPost("image");
    $id = $app->request->getPost("id");

    $sql = "UPDATE kmom05_movie SET title = ?, year = ?, image = ? WHERE id = ?;";
    $app->db->execute($sql, [$title, $year, $image, $id]);


    return $app->response->redirect("movie");
});



/**
 * CRUD - delete.
 */
 $app->router->get("movie/delete", function () use ($app) {
     $title = "Delete movies | oophp";

     $movieId = $app->request->getGet("movieId");
     $sql = "SELECT * FROM kmom05_movie WHERE id = ?;";
     $app->db->connect();
     $res = $app->db->executeFetch($sql, [$movieId]);

     $app->page->add("movie/delete", [
         "resultset" => $res,
     ]);

     return $app->page->render([
         "title" => $title,
     ]);
 });


$app->router->post("movie/delete", function () use ($app) {

    $movieId = $app->request->getGet("movieId");

    $app->db->connect();
    $id = $app->request->getPost("id");
    $sql = "DELETE FROM kmom05_movie WHERE id = ?;";

    $app->db->execute($sql, [$movieId]);


    return $app->response->redirect("movie");
});

/**
 * CRUD - Add.
 */

$app->router->get("movie/add", function () use ($app) {
    $title = "Add movies | oophp";

    $app->page->add("movie/add");

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/add", function () use ($app) {

    $app->db->connect();
    $year = $app->request->getPost("year");
    $title = $app->request->getPost("title");
    $image = $app->request->getPost("image");

    $sql = "INSERT INTO kmom05_movie (title, year, image) VALUES (?, ?, ?);";
    $app->db->execute($sql, [$title, $year, $image]);


    return $app->response->redirect("movie");
});
