<?php

namespace Vibe\Order;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class OrderRow extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "OrderRow";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $orderId;
    public $productId;
    public $productName;
    public $quantity;
    public $size;
    public $price;



    public function createOrderRow($orderId, $product)
    {
        $this->orderId = $orderId;
        $this->productId = $product["productId"];
        $this->productName = $product["name"];
        $this->quantity = $product["quantity"];
        $this->size = $product["size"];
        $this->price = $product["price"];
        $this->save();
    }
}
