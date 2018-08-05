<?php

namespace Vibe\Category;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class CategoryProduct extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "CategoryProduct";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $categoryId;
    public $productId;
}
