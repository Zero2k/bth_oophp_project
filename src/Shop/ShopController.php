<?php

namespace Vibe\Shop;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Product\Product;
use \Vibe\Category\CategoryProduct;
use \Vibe\Shop\Shop;
use \Vibe\User\User;
use \Vibe\Order\Order;
use \Vibe\Order\OrderRow;
use \Vibe\CartSession\CartSession;
use \Vibe\Pagination\Pagination;

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

        $this->user = new User();
        $this->user->setDb($this->di->get("database"));

        $this->order = new Order();
        $this->order->setDb($this->di->get("database"));

        $this->pagination = new Pagination();

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
        $di         = $this->di;

        $search = isset($_GET["search"]) ? htmlentities($_GET["search"]) : '';
        $category = isset($_GET["category"]) ? $_GET["category"] : 'all';
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $sort = isset($_GET["sort"]) ? $_GET["sort"] : 'id';
        $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
        $offset = ($currentPage - 1) * $limit;

        $categories = $this->categoryProduct->getAllCategories();
        
        switch ($category) {
            case 'all':
                $query = "SELECT id FROM oophp_Product";
                $total = count($this->shop->getTotal($query, []));

                $products = $this->product->getProducts($limit, $offset, $sort);
                break;
                
            case $category:
                $query = "SELECT Product.* FROM oophp_Product Product
                LEFT JOIN oophp_CategoryProduct CP ON CP.productId = Product.id
                LEFT JOIN oophp_Category Category ON Category.id = CP.categoryId
                WHERE Category.category = ?";
                $total = count($this->shop->getTotal($query, [$category]));

                $products = $this->shop->getAllProductsByCategory($category, $limit, $offset, $sort);
                break;
            
            default:
                $query = "SELECT id FROM oophp_Product";
                $total = count($this->shop->getTotal($query, []));

                $products = $this->product->getProducts($limit, $offset, $sort);
                break;
        }
        
        if ($search) {
            $query = "SELECT * FROM oophp_Product Product WHERE Product.name LIKE '%$search%' OR Product.description LIKE '%$search%'";
            $total = count($this->shop->getTotal($query, []));

            $products = $this->product->searchProduct($search, $limit, $offset);
        }

        $pagination = $this->pagination->renderPagination($total, $offset, $limit, $currentPage, $category, $sort, $search, $di);

        $data = [
            "products" => $products,
            "categories" => $categories,
            "pagination" => $pagination,
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



    public function checkoutCart()
    {
        $this->init();
        $title      = "Cart - Checkout";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $products = $this->cartSession->getProducts();

        if ($userId && $products) {
            if (isset($_POST["fullName"]) && isset($_POST["cardNumber"]) && isset($_POST["expiration"]) && isset($_POST["cvv"])) {
                $fullName = isset($_POST["fullName"]) ? $_POST["fullName"] : '';
                $cardNumber = isset($_POST["cardNumber"]) ? $_POST["cardNumber"] : '';
                $expiration = isset($_POST["expiration"]) ? $_POST["expiration"] : '';
                $cvv = isset($_POST["cvv"]) ? $_POST["cvv"] : '';

                $order = $this->order->createOrder($userId, $fullName, $cardNumber, $expiration, $cvv);
                /* If order was created then start to create orderRows */
                if ($order && !empty($products)) {
                    foreach ($products as $product) {
                        $orderRow = new OrderRow();
                        $orderRow->setDb($this->di->get("database"));
                        $orderRow->createOrderRow($order->id, $product);
                    }
                }
                $this->session->delete("cart");
                $this->di->get("response")->redirect("");
            }
        } else {
            $this->di->get("response")->redirect("login");
        }

        $data = [
            "cart" => $products,
            "total" => $this->cartSession->calculateTotal(),
            "user" => $this->user->getUserInfo($userId),
        ];

        $view->add("shop/checkout", $data);
        $pageRender->renderPage(["title" => $title]);
    }
}
