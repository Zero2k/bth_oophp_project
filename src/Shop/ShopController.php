<?php

namespace Vibe\Shop;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Product\Product;

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

            case 'shoes':
                $products = $this->product->getProducts(1);
                break;

            case 'clothing':
                $products = $this->product->getProducts(2);
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

}
