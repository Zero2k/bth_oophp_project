<?php

namespace Vibe\Category;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Category extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Category";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $category;
}
