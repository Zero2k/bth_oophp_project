<?php

namespace Vibe\CartSession;

use \Vibe\Product\Product;

/**
 * Unit test for CartSession class
 */

class CartSessionTest extends \PHPUnit_Framework_TestCase
{
    protected $di;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->cartSession = new CartSession();
        $this->cartSession->inject(["session" => $this->di->get("session")]);

        $this->product = new Product();
        $this->product->setDb($this->di->get("database"));
    }



    public function testSaveDataset()
    {
        $product = [
            "id" => 1,
            "productId" => 1,
            "name" => "First product",
            "image" => "image",
            "available" => 1,
            "quantity" => 2,
            "size" => "S",
            "price" => 20,
        ];

        $allProducts[] = $product;

        /* Add initial product to cart */
        $this->cartSession->saveDataset($allProducts);

        $response = $this->cartSession->getProducts();
        $this->assertEquals(1, count($response));
    }



    public function testGetProducts()
    {
        $response = $this->cartSession->getProducts();
        $this->assertEquals(0, count($response));
    }



    public function testAddProduct()
    {
        $product = [
            "id" => 1,
            "productId" => 1,
            "name" => "First product",
            "image" => "image",
            "available" => 1,
            "quantity" => 2,
            "size" => "S",
            "price" => 20,
        ];

        $allProducts[] = $product;

        /* Add initial product to cart */
        $this->cartSession->saveDataset($allProducts);

        $product = $product = $this->product->find("id", 1);
        
        $response = $this->cartSession->addProduct($product, 2, "S");
        $this->assertEquals("S", $response["size"]);
    }



    public function testUpdateProduct()
    {
        $product = [
            "id" => 1,
            "productId" => 1,
            "name" => "First product",
            "image" => "image",
            "available" => 1,
            "quantity" => 2,
            "size" => "S",
            "price" => 20,
        ];

        $allProducts[] = $product;

        /* Add initial product to cart */
        $this->cartSession->saveDataset($allProducts);

        $product = $product = $this->product->find("id", 1);
        
        $response = $this->cartSession->updateProductRow($product, 1, "M", 4);
    }



    public function testProductExists()
    {
        $product = [
            "id" => 1,
            "productId" => 1,
            "name" => "First product",
            "image" => "image",
            "available" => 1,
            "quantity" => 2,
            "size" => "S",
            "price" => 20,
        ];

        $allProducts[] = $product;

        /* Add initial product to cart */
        $this->cartSession->saveDataset($allProducts);

        $product = $product = $this->product->find("id", 1);
        
        /* Add another product to cart */
        $this->cartSession->addProduct($product, 2, "S");

        $response = $this->cartSession->productExists(1, "S");
        $this->assertEquals("S", $response["size"]);

        /* Remove both products from cart */
        $this->cartSession->removeProduct(1);
        $this->cartSession->removeProduct(2);

        /* Check if cart is empty */
        $response2 = $this->cartSession->productExists(4, "S");
        $this->assertEquals(null, $response2);
    }



    public function testCalculateTotat()
    {
        $product = [
            "id" => 1,
            "productId" => 1,
            "name" => "First product",
            "image" => "image",
            "available" => 1,
            "quantity" => 2,
            "size" => "S",
            "price" => 20,
        ];

        $allProducts[] = $product;

        /* Add initial product to cart */
        $this->cartSession->saveDataset($allProducts);

        $product = $product = $this->product->find("id", 1);
        
        /* Add another product to cart */
        $this->cartSession->addProduct($product, 1, "S");
        
        $response = $this->cartSession->calculateTotal();
        $this->assertEquals(54, $response);

        /* Remove both products from cart */
        $this->cartSession->removeProduct(1);
        $this->cartSession->removeProduct(2);

        $response2 = $this->cartSession->calculateTotal();
        $this->assertEquals(0, $response2);
    }
}
