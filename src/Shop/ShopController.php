<?php

namespace Vibe\Shop;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Product\Product;
use \Vibe\Category\CategoryProduct;
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

        $this->categoryProduct = new CategoryProduct();
        $this->categoryProduct->setDb($this->di->get("database"));

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
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;

        switch ($category) {
            case 'all':
                $products = $this->product->getProducts($limit);
                break;

            case 'dresses':
                $products = $this->shop->getAllProductsByCategory("dresses", $limit);
                break;

            case 'shirts':
                $products = $this->shop->getAllProductsByCategory("shirts", $limit);
                break;

            case 'shorts':
                $products = $this->shop->getAllProductsByCategory("shorts", $limit);
                break;

            case 'pants':
                $products = $this->shop->getAllProductsByCategory("pants", $limit);
                break;

            default:
                $products = $this->product->getProducts($limit);
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
            "categories" => $this->categoryProduct->getCategoriesToProduct($id),
            "product" => $this->product->getProduct($id),
        ];

        $view->add("shop/productView", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show cart page.
     *
     * @return void
     */
    public function getCart()
    {
        $this->init();
        $title      = "View Cart";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "cart" => "cart",
        ];

        $view->add("shop/cart", $data);
        $pageRender->renderPage(["title" => $title]);
    }
}
