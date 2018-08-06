<?php

namespace Vibe\Product;

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
            return $product;
        }, $preducts);

        return $preducts;
    }
}
