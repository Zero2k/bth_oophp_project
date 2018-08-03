<?php

namespace Vibe\Post;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;
use \Anax\TextFilter\TextFilter;

/**
 * A database driven model.
 */
class Post extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Post";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $content;
    public $html;
    public $title;
    public $slug;
    public $image;
    public $category;



    public function createPost($userId, $content, $title, $image, $category)
    {
        $this->userId = $userId;
        $this->content = $content;
        $this->title = $title;
        $this->image = $image;
        $this->category = $category;
        $this->html = $this->parseContent($content);
        $this->slug = $this->slugify($title);
        $this->save();
        return $this;
    }



    public function updatePost($postId, $userId, $content, $title, $image, $category)
    {
        $post = $this->find("id", $postId);

        $post->userId = $userId;
        $post->content = $content;
        $post->title = $title;
        $post->image = $image;
        $post->category = $category;
        $post->html = $this->parseContent($content);
        $post->slug = $this->slugify($title);
        $post->update();
        return $post;
    }



    public function getPosts($limit = 10, $order = "id")
    {
        $sql = 'SELECT * FROM oophp_Post Post 
        ORDER BY '.$order.' ASC 
        LIMIT ?';

        $posts = $this->findAllSql($sql, [$limit]);
        $posts = array_map(function ($post) {
            $post->id = $post->id;
            $post->userId = $post->userId;
            $post->content = $post->content;
            $post->html = $post->html;
            $post->title = $post->title;
            $post->slug = $post->slug;
            $post->image = $post->image;
            $post->category = $post->category;
            return $post;
        }, $posts);

        return $posts;
    }


    public function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }



    public function parseContent($content)
    {
        $textfilter = new TextFilter();
        return $textfilter->parse($content, ["markdown", "clickable"])->text;
    }
}
