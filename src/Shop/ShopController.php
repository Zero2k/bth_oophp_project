<?php

namespace Vibe\Shop;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Product\Product;
use \Vibe\Category\CategoryProduct;
use \Vibe\Shop\Shop;
use \Vibe\CartSession\CartSession;

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

        $this->cartSession = new CartSession();
        $this->cartSession->inject(["session" => $this->di->get("session")]);

        $this->session = $this->di->get("session");
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

        $search = isset($_GET["search"]) ? $_GET["search"] : '';
        $category = isset($_GET["category"]) ? $_GET["category"] : 'all';
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $categories = $this->categoryProduct->getAllCategories();

        switch ($category) {
            case 'all':
                $products = $this->product->getProducts($limit);
                break;

            case $category:
                $products = $this->shop->getAllProductsByCategory($category, $limit);
                break;

            default:
                $products = $this->product->getProducts($limit);
                break;
        }

        if ($search) {
            $products = $this->product->searchProduct($search);
        }

        $data = [
            "products" => $products,
            "categories" => $categories,
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

        if (isset($_POST["delete"])) {
            $id = $_POST["delete"];
            $this->cartSession->removeProduct($id);
            $this->session->set("message", "Product was removed.");
        } else if (isset($_POST["update"])) {
            $id = $_POST["update"];
            $size = $_POST["size"];
            $quantity = $_POST["quantity"];
            if ($quantity > 0) {
                $product = $this->product->find("id", $id);
                $this->session->set("message", "$product->name has been updated!");
                $this->cartSession->updateProductRow($product, $id, $size, $quantity);
            }
        }

        $data = [
            "products" => $this->cartSession->getProducts(),
            "total" => $this->cartSession->calculateTotal(),
        ];

        $view->add("shop/cart", $data);
        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Add product to cart route.
     *
     * @return void
     */
    public function postAddToCart()
    {
        $this->init();

        $id = isset($_POST["productId"]) ? $_POST["productId"] : '';
        $size = isset($_POST["size"]) ? $_POST["size"] : 'S';
        $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : '1';
        $requestType = isset($_POST["requestType"]) ? $_POST["requestType"] : '';

        /* CHECK IF PRODUCT ALREADY EXIST IN SESSION */
        $existingProduct = $this->cartSession->productExists($id, $size);
        $product = $this->product->find("id", $id);

        if (!$existingProduct) {
            if ($product) {
                $this->cartSession->addProduct($product, $quantity, $size);
                if (!$requestType) {
                    $this->session->set("message-$product->id", "Product added to cart!");
                }
            } else {
                $this->session->set("message", "Error!");
            }
        } else if ($existingProduct && $requestType === "ajax") {
            die(header("HTTP/1.0 409 Conflict (Product already added to cart)", true, 409));
        } else {
            $this->session->set("message-$product->id", "Product already added to cart!");
        }

        $this->di->get("response")->redirect($_SERVER["HTTP_REFERER"]);
    }


    /**
     * Remove cart route.
     *
     * @return void
     */
    public function removeCart()
    {
        $this->init();

        $this->session->delete("cart");
        $this->di->get("response")->redirect($_SERVER["HTTP_REFERER"]);
    }
}
