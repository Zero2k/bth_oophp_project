<?php

namespace Vibe\User;

/**
 * Unit test for User class
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



    public function testUserExists()
    {
        $response = $this->user->userExists("test@test.com");
        $this->assertTrue($response);

        $response = $this->user->userExists("test3@test.com");
        $this->assertFalse($response);
    }



    public function testGetUsers()
    {
        $response = $this->user->getUsers(2);
        $this->assertEquals(2, count($response));
    }



    public function testGetUserInfo()
    {
        $response = $this->user->getUserInfo(1);
        $this->assertEquals($response->id, 1);
    }
}
