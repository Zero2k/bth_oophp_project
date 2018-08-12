<?php

namespace Vibe\Shop;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Product\Product;
use \Vibe\Shop\Shop;

/**
* Routes class.
*/
class ShopController implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;



    public function init()
    {
        $this->product = new Product();
        $this->product->setDb($this->di->get("database"));

        $this->shop = new Shop();
        $this->shop->setDb($this->di->get("database"));
    }



    /**
     * Show shop page.
     *
     * @return void
     */
    public function getShop()
    {
        $this->init();
        $title      = "Shop";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $category = isset($_GET["category"]) ? $_GET["category"] : '';

        switch ($category) {
            case 'all':
                $products = $this->product->getProducts(10);
                break;

            case 'dresses':
                $products = $this->shop->getAllProductsByCategory("dresses", 10);
                break;

            case 'shirts':
                $products = $this->shop->getAllProductsByCategory("shirts", 10);
                break;

            case 'shorts':
                $products = $this->shop->getAllProductsByCategory("shorts", 10);
                break;

            case 'pants':
                $products = $this->shop->getAllProductsByCategory("pants", 10);
                break;

            default:
                $products = $this->product->getProducts(10);
                break;
        }

        $data = [
            "products" => $products,
        ];

        $view->add("shop/shop", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show product page.
     *
     * @return void
     */
    public function getProduct($id)
    {
        $this->init();
        $title      = "View Product";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "product" => "product",
        ];

        $view->add("shop/productView", $data);
        $pageRender->renderPage(["title" => $title]);
    }
}
