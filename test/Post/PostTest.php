<?php

namespace Vibe\Post;

/**
 * Unit test for Post class
 */

class PostTest extends \PHPUnit_Framework_TestCase
{
    protected $di;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->post = new Post();
        $this->post->setDb($this->di->get("database"));
    }



    public function testGetPosts()
    {
        $response = $this->post->getPosts();
        $this->assertGreaterThan(1, count($response));
    }



    public function testUpdatePost()
    {
        $currentPost = [
            "userId" => 1,
            "content" => "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.

            Curabitur blandit tempus porttitor. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.
            
            Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.",
            "title" => "title of a longer featured blog post",
            "image" => "pexels-photo.jpeg",
            "category" => "news",
        ];

        $newPost = [
            "userId" => 1,
            "content" => "test",
            "title" => "just a test",
            "image" => "pexels-photo.jpeg",
            "category" => "news",
        ];

        // updatePost($postId, $userId, $content, $title, $image, $category)
        $response = $this->post->updatePost(1, 1, $newPost["content"], $newPost["title"], $newPost["image"], $newPost["category"]);
        $this->assertEquals($newPost["content"], $response->content);

        $this->post->updatePost(1, 1, $currentPost["content"], $currentPost["title"], $currentPost["image"], $currentPost["category"]);
    }



    public function testGetPost()
    {
        $slug = "title-of-a-longer-featured-blog-post";

        $response = $this->post->getPost($slug);
        $this->assertEquals($slug, $response->slug);
        $this->assertEquals("news", $response->category);
    }
}
