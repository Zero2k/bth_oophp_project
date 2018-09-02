<?php

namespace Vibe\Shop;

/**
 * Unit test for Shop class
 */

class ShopTest extends \PHPUnit_Framework_TestCase
{
    protected $di;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->shop = new Shop();
        $this->shop->setDb($this->di->get("database"));
    }



    public function testGetAllProductByCategory()
    {
        $response = $this->shop->getAllProductsByCategory("dresses", 10, 0);
        $this->assertEquals(2, count($response));
    }



    public function testGetTotal()
    {
        $query = "SELECT id FROM oophp_Product";
        $total = count($this->shop->getTotal($query, []));
        $this->assertEquals(3, $total);
    }
}
