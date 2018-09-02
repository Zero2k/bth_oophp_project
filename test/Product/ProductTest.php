<?php

namespace Vibe\Product;

/**
 * Unit test for Product class
 */

class ProductTest extends \PHPUnit_Framework_TestCase
{
    protected $di;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->product = new Product();
        $this->product->setDb($this->di->get("database"));
    }



    public function testGetProducts()
    {
        $response = $this->product->getProducts(1);
        $this->assertEquals(1, count($response));
    }



    public function testGetProductsWhere()
    {
        $response = $this->product->getProductsWhere(5);
        $this->assertEquals(2, count($response));
    }



    public function testGetProduct()
    {
        $response = $this->product->getProduct(1);
        $this->assertEquals(1, count($response));
    }



    public function testGetTopSellers()
    {
        $response = $this->product->getTopSellers(10);
        $this->assertEquals(1, $response[0]->productId);
    }



    public function testSearchProduct()
    {
        $response = $this->product->searchProduct("description");
        $this->assertEquals(3, count($response));
    }
}
