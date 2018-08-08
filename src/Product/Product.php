<?php

namespace Vibe\Product;

use \Vibe\Category\Category;
use \Vibe\Category\CategoryProduct;
use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;
use \Anax\TextFilter\TextFilter;

/**
 * A database driven model.
 */
class Product extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Product";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $name;
    public $description;
    public $text;
    public $price;
    public $old_price;
    public $image;
    public $stock;



    /**
     * Get products.
     *
     * @param integer $limit.
     *
     * @return objects.
     */
    public function getProducts($limit, $order = "id")
    {
        $sql = 'SELECT * FROM oophp_Product Product 
        ORDER BY '.$order.' ASC 
        LIMIT ?';

        $preducts = $this->findAllSql($sql, [$limit]);
        $preducts = array_map(function ($product) {
            $product->id = $product->id;
            $product->userId = $product->userId;
            $product->name = $product->name;
            $product->descriptin = $product->description;
            $product->text = $product->text;
            $product->price = $product->price;
            $product->old_price = $product->old_price;
            $product->image = $product->image;
            $product->stock = $product->stock;
            return $product;
        }, $preducts);

        return $preducts;
    }



    public function addProduct($userId, $name, $text, $description, $price, $image, $stock)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->text = $text;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->stock = $stock;
        $this->save();
        return $this;
    }



    public function createProduct($userId, $name, $text, $description, $price, $image, $stock, $categories, $di)
    {
        $newProduct = $this->addProduct($userId, $name, $text, $description, $price, $image, $stock);

        if (!empty($categories)) {
            foreach ($categories as $categoryId) {
                $categoryProduct = new CategoryProduct();
                $categoryProduct->setDb($di->get("database"));
                $categoryProduct->createCategoryRelation($categoryId, $newProduct->id);
            }
        }

        return $newProduct;
    }



    /* public function updateProduct($productId, $userId, $name, $text, $description, $price, $image, $stock, $categories, $di)
    {
        # code...
    } */
}
