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

        $resultset = $this->content->getAllContent();

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
    public function createActionGet() : object
    {
        $title = "Create content | oophp";

        $this->app->page->add("content/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Create
     *
     *
     * @return object AS page
     */
    public function createActionPost() : object
    {
        $title = $this->app->request->getPost("contentTitle");

        $id = $this->content->create($title);

        return $this->app->response->redirect("content/edit/" . $id);
    }

    /**
     * Edit
     *
     *
     * @return object As page
     */
    public function editActionGet($id) : object
    {
        $title = "Edit | oophp";

        $content = $this->content->getContent($id);

        $this->app->page->add("content/edit", [
            "content" => $content,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Edit
     *
     *
     * @return object AS page
     */
    public function editActionPost($id) : object
    {
        $doDelete = $this->app->request->getPost("doDelete");
        $doSave = $this->app->request->getPost("doSave");
        if (isset($doDelete)) {
            return $this->app->response->redirect("content/delete/" . $id);
        } elseif (isset($doSave)) {
            $title = $this->app->request->getPost("contentTitle");
            $path = $this->app->request->getPost("contentPath");
            $slug = $this->app->request->getPost("contentSlug");
            $data = $this->app->request->getPost("contentData");
            $type = $this->app->request->getPost("contentType");
            $filter = $this->app->request->getPost("contentFilter");
            $publish = $this->app->request->getPost("contentPublish");
            $id = $this->app->request->getPost("contentId");

            if (!$slug) {
                    $slug = slugify($title);
                }

            if (!$path) {
                $path = null;
            }

            $params = [$title, $path, $slug, $data, $type, $filter, $publish, $id];

            $this->content->updateContent($params);
        }

        return $this->app->response->redirect("content/index");
    }

    /**
     * delete
     *
     *
     * @return object As page
     */
    public function deleteActionGet($id) : object
    {
        $title = "Delete | oophp";
        if (!is_numeric($id)) {
            die("Not valid for content id.");
        }
        $content = $this->content->getContent($id);

        $this->app->page->add("content/delete", [
            "content" => $content,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Delete
     *
     *
     * @return object AS page
     */
    public function deleteActionPost($id) : object
    {

        if ($this->app->request->getPost("doDelete")) {
            $this->content->deleteContent($id);
        }


        return $this->app->response->redirect("content/admin");
    }


}
