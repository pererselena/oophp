<?php

namespace Elpr\Movie;

use Anax\Response\ResponseUtility;
//use Anax\Page\Page;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class MovieControllerTest extends TestCase
{
    private $controller;
    private $app;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;
        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new MovieController();
        $this->controller->setApp($app);
    }

    /**
     * Call the controller index action.
     */
    // public function testIndexAction()
    // {
    //     $res = $this->controller->indexAction();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }


    /**
     * Call controller searchTitleActionGet action
     *
    **/
    public function testSearchTitleActionGet()
    {
        $res = $this->controller->searchTitleActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call controller searchTitleActionPost action
     *
    **/
    // public function testSearchTitleActionPost()
    // {
    //     $res = $this->controller->searchTitleActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call controller searchYearActionGet action
     *
    **/
    public function testSearchYearActionGet()
    {
        $res = $this->controller->searchYearActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call controller searchYearActionPost action
     *
    **/
    // public function testSearchYearActionPost()
    // {
    //     $res = $this->controller->searchYearActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call controller editYearActionGet action
     *
    **/
    // public function testEditActionGet()
    // {
    //     $res = $this->controller->editActionGet();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call controller searchYearActionPost action
     *
    **/
    // public function testEditActionPost()
    // {
    //     $res = $this->controller->editActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call controller deleteActionGet action
     *
    **/
    // public function testDeleteActionGet()
    // {
    //     $res = $this->controller->deleteActionGet();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call controller deleteActionPost action
     *
    **/
    // public function testDeleteActionPost()
    // {
    //     $res = $this->controller->deleteActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call controller addActionGet action
     *
    **/
    public function testAddActionGet()
    {
        $res = $this->controller->addActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call controller addActionPost action
     *
    **/
    // public function testAddActionPost()
    // {
    //     $res = $this->controller->addActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }
}
