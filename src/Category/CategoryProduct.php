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



    /**
     * Return all categories
     *
     * @param integer $limit.
     *
     * @return array
     */
    public function getAllCategories($limit = 10)
    {
        $sql = 'SELECT Category.id, Category.category, count(CategoryProduct.categoryId) as total FROM oophp_Category Category 
        LEFT JOIN oophp_CategoryProduct CategoryProduct ON Category.id = CategoryProduct.categoryId 
        GROUP BY Category.id ASC 
        ORDER BY total DESC 
        LIMIT ?';
        return $this->findAllSql($sql, [$limit]);
    }



    public function findCategoriesToProduct($productId)
    {
        $sql = 'SELECT * FROM oophp_CategoryProduct CategoryProduct 
        WHERE CategoryProduct.productId = ?';

        $categories = $this->findAllSql($sql, [$productId]);

        return $categories;
    }



    public function createCategoryRelation($categoryId, $productId)
    {
        $this->categoryId = $categoryId;
        $this->productId = $productId;
        $this->save();
    }



    public function getCategoriesToProduct($productId)
    {
        $sql = 'SELECT category FROM oophp_Category Category
        LEFT JOIN oophp_CategoryProduct CategoryProduct
        ON CategoryProduct.categoryId = Category.id 
        WHERE CategoryProduct.productId = ?';

        $categories = $this->findAllSql($sql, [$productId]);

        return $categories;
    }
}
