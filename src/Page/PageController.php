<?php

namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Content\Content;

/**
* Routes class.
*/
class PageController implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;



    public function init()
    {
        $this->content = new Content();
        $this->content->setDb($this->di->get("database"));
    }



    /**
     * Show home page.
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Home";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "items" => "items",
        ];

        $view->add("page/index", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show shop page.
     *
     * @return void
     */
    public function getShop()
    {
        $title      = "Shop";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "items" => "items",
        ];

        $view->add("page/shop", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show blog page.
     *
     * @return void
     */
    public function getBlog()
    {
        $title      = "Blog";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "items" => "items",
        ];

        $view->add("page/blog", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show about page.
     *
     * @return void
     */
    public function getAbout()
    {
        $this->init();
        $title      = "About";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "content" => $this->content->getContent("about"),
        ];

        $view->add("page/about", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show contact page.
     *
     * @return void
     */
    public function getContact()
    {
        $title      = "Contact";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "items" => "items",
        ];

        $view->add("page/contact", $data);
        $pageRender->renderPage(["title" => $title]);
    }
}
