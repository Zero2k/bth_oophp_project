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



    public function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }
}
