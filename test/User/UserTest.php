<?php

namespace Vibe\User;

/**
 * Unit test for Gravatar class
 */

class UserTest extends \PHPUnit_Framework_TestCase
{
    protected $di;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->user = new User();
        $this->user->setDb($this->di->get("database"));
    }



    public function testuserExists()
    {
        $response = $this->user->userExists("test@test.com");
        $this->assertTrue($response);

        $response = $this->user->userExists("test3@test.com");
        $this->assertFalse($response);
    }



    public function testgetUsers()
    {
        $response = $this->user->getUsers(2);
        $this->assertEquals(2, count($response));
    }
}
