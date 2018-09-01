<?php

namespace Vibe\Category;

/**
 * Unit test for Product class
 */

class CategoryTest extends \PHPUnit_Framework_TestCase
{
    protected $di;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->category = new Category();
        $this->category->setDb($this->di->get("database"));
    }



    public function testGetCategories()
    {
        $response = $this->category->getCategories(3);
        $this->assertEquals(3, count($response));
    }



    public function testUpdateCategory()
    {
        $response = $this->category->updateCategory(1, "dress");
        $this->assertEquals("dress", $response->category);

        /* Reset category to initial value */
        $this->category->updateCategory(1, "dresses");
    }
}
