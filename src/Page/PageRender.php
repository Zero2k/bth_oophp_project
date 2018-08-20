<?php

namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Vibe\Content\Content;
use \Vibe\CartSession\CartSession;

/**
 * A default page rendering class.
 */
class PageRender implements PageRenderInterface, InjectionAwareInterface
{
    use InjectionAwareTrait;



    public function init()
    {
        $this->content = new Content();
        $this->content->setDb($this->di->get("database"));

        $this->cartSession = new CartSession();
        $this->cartSession->inject(["session" => $this->di->get("session")]);
    }



    /**
     * Render a standard web page using a specific layout.
     *
     * @param array   $data   variables to expose to layout view.
     * @param integer $status code to use when delivering the result.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.ExitExpression)
     */
    public function renderPage($data, $status = 200)
    {
        $this->init();
        $data["stylesheets"] = ["https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css", "css/color.css", "css/blog.css", "css/shop.css", "css/cart.css", "css/carousel.css", "css/offcanvas.css", "css/style.css"];

        $data["javascript"] = ["js/product.js", "js/shop.js", "js/offcanvas.js"];

        $data["footer"] = $this->content->getContent("footer");
        $data["cart"] = count($this->cartSession->getProducts());
        
        // Add common header, navbar and footer
        $view = $this->di->get("view");
        // $this->view->add("layout/header", [], "header");
        /* $view->add("layout/subnavbar", [], "subnavbar"); */
        $view->add("layout/navbar", $data, "navbar");
        $view->add("layout/footer", $data, "footer");
        // Add layout, render it, add to response and send.
        $view->add("layout/app", $data, "app");
        $body = $view->renderBuffered("app");
        $this->di->get("response")->setBody($body)
                       ->send($status);
        exit;
    }
}
