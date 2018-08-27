<?php

namespace Vibe\Order;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Order extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Order";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $created;



    public function createOrder($userId)
    {
        $this->userId = $userId;
        $this->created = date('Y-m-d G:i:s');
        $this->save();
        return $this;
    }
}
