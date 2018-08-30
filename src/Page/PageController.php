<?php

namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Content\Content;
use \Vibe\Post\Post;
use \Vibe\Product\Product;
use \Vibe\Category\CategoryProduct;
use \Vibe\CategoryCloud\CategoryCloud;

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

        $this->post = new Post();
        $this->post->setDb($this->di->get("database"));

        $this->product = new Product();
        $this->product->setDb($this->di->get("database"));

        $this->categoryProduct = new CategoryProduct();
        $this->categoryProduct->setDb($this->di->get("database"));

        $this->categoryCloud = new CategoryCloud();
    }



    /**
     * Show home page.
     *
     * @return void
     */
    public function getIndex()
    {
        $this->init();
        $title      = "Home";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $categories = $this->categoryProduct->getAllCategories();
        $categoryCloud = $this->categoryCloud->generateCloud($categories);

        $data = [
            "categoryCloud" => $categoryCloud,
            "featuredProducts" => $this->product->getProductsWhere(4, "created", "featured = 1"),
            "latestProducts" => $this->product->getProducts(3, 0, "created", "DESC"),
            "offerProducts" => $this->product->getProductsWhere(3, "created", "offer = 1"),
            "topSellers" => $this->product->getTopSellers(3),
            "latestPosts" => $this->post->getPosts(4, "created"),
        ];

        $view->add("page/index", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show blog page.
     *
     * @return void
     */
    public function getBlog()
    {
        $this->init();
        $title      = "Blog";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "posts" => $this->post->getPosts(10),
        ];

        $view->add("page/blog", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show blog view page.
     *
     * @return void
     */
    public function getBlogView($slug)
    {
        $this->init();
        $title      = "Blog View";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "post" => $this->post->getPost($slug),
        ];

        $view->add("page/blogView", $data);
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
