<?php

namespace Vibe\Content;

/**
 * Unit test for Content class
 */

class ContentTest extends \PHPUnit_Framework_TestCase
{
    protected $di;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->content = new Content();
        $this->content->setDb($this->di->get("database"));
    }



    public function testGetContent()
    {
        $response = $this->content->getContent("footer");
        $this->assertEquals("footer", $response->type);
    }



    public function testUpdateContent()
    {
        $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam id purus at risus pellentesque faucibus a quis eros. In eu fermentum leo.";

        $newContent = "NEW - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam id purus at risus pellentesque faucibus a quis eros. In eu fermentum leo.";

        $response = $this->content->updateContent(1, $newContent, "footer");
        $this->assertEquals($newContent, $response->content);

        /* Reset content to initial value */
        $this->content->updateContent(1, $content, "footer");
    }
}
