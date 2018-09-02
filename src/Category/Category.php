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



    /**
     * Get categories.
     *
     * @param integer $limit.
     *
     * @return objects.
     */
    public function getCategories($limit, $order = "id")
    {
        $sql = 'SELECT * FROM oophp_Category Category 
        ORDER BY '.$order.' ASC 
        LIMIT ?';

        $categories = $this->findAllSql($sql, [$limit]);
        $categories = array_map(function ($category) {
            $category->id = $category->id;
            $category->category = $category->category;
            return $category;
        }, $categories);

        return $categories;
    }



    /**
     * Create category.
     *
     * @param string $category.
     *
     * @return object.
     */
    public function createCategory($category)
    {
        $this->category = $category;
        $this->save();
        return $this;
    }



    /**
     * Update category.
     *
     * @param id $productId.
     * @param string $category.
     *
     * @return object.
     */
    public function updateCategory($categoryId, $category)
    {
        $cat = $this->find("id", $categoryId);

        $cat->category = strtolower($category);
        $cat->update();
        return $cat;
    }
}
