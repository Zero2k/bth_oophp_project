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
    public $offer;
    public $featured;



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

        $products = $this->findAllSql($sql, [$limit]);
        $products = array_map(function ($product) {
            $product->id = $product->id;
            $product->userId = $product->userId;
            $product->name = $product->name;
            $product->descriptin = $product->description;
            $product->text = $product->text;
            $product->price = $product->price;
            $product->old_price = $product->old_price;
            $product->image = $product->image;
            $product->stock = $product->stock;
            $product->offer = $product->offer;
            $product->featured = $product->featured;
            return $product;
        }, $products);

        return $products;
    }



    public function addProduct($userId, $name, $text, $description, $price, $image, $stock, $offer, $featured)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->text = $text;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->stock = $stock;
        $this->offer = $offer;
        $this->featured = $featured;
        $this->save();
        return $this;
    }



    public function createProduct($userId, $name, $text, $description, $price, $image, $stock, $offer, $featured, $categories, $di)
    {
        $newProduct = $this->addProduct($userId, $name, $text, $description, $price, $image, $stock, $offer, $featured);

        if (!empty($categories)) {
            foreach ($categories as $categoryId) {
                $categoryProduct = new CategoryProduct();
                $categoryProduct->setDb($di->get("database"));
                $categoryProduct->createCategoryRelation($categoryId, $newProduct->id);
            }
        }

        return $newProduct;
    }



    public function updateProduct($productId, $userId, $name, $text, $description, $price, $image, $stock, $offer, $featured, $categories, $di)
    {
        $categoryProduct = new CategoryProduct();
        $categoryProduct->setDb($di->get("database"));
        $currentCategories = $categoryProduct->findCategoriesToProduct($productId);
        $currentIds = array_column($currentCategories, "categoryId");

        $product = $this->find("id", $productId);
        $product->userId = $userId;
        $product->name = $name;
        $product->text = $text;
        $product->description = $description;

        if ($product->price <= $price && $product->price !== $price) {
            $product->price = $price;
            $product->old_price = 0;
        } else {
            $product->old_price = $product->price;
            $product->price = $price;
        }

        $product->image = $image;
        $product->stock = $stock;
        $product->offer = $offer;
        $product->featured = $featured;

        if ($categories) {
            $ids_to_insert = array_diff($categories, $currentIds);
            
            foreach ($ids_to_insert as $newId) {
                $newCat = new CategoryProduct();
                $newCat->setDb($di->get("database"));
                $newCat->categoryId = $newId;
                $newCat->productId = $productId;
                $newCat->save();
            }

            $ids_to_delete = array_diff($currentIds, $categories);

            if ($ids_to_delete) {
                $deleteCat = new CategoryProduct();
                $deleteCat->setDb($di->get("database"));
                foreach ($ids_to_delete as $deleteId) {
                    $deleteCat->findWhere("productId = ? AND categoryId = ?", [$productId, $deleteId]);
                    $deleteCat->delete();
                }
            }
        }

        $product->save();
        return $product;
    }
}
