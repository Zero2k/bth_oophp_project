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
    public $fullName;
    public $cardNumber;
    public $expiration;
    public $cvv;
    public $created;



    /**
     * Get all orders.
     *
     * @param integer $limit.
     *
     * @return objects.
     */
    public function getOrders($limit = 20)
    {
        $sql = 'SELECT * FROM oophp_Order Orders
        ORDER BY id ASC
        LIMIT ?';

        $orders = $this->findAllSql($sql, [$limit]);
        $orders = array_map(function ($order) {
            $order->id = $order->id;
            $order->userId = $order->userId;
            $order->fullName = $order->fullName;
            $order->cardNumber = $order->cardNumber;
            $order->expiration = $order->expiration;
            $order->cvv = $order->cvv;
            $order->created = $order->created;
            return $order;
        }, $orders);

        return $orders;
    }



    /**
     * Get user orders.
     *
     * @param integer $userId.
     *
     * @return objects.
     */
    public function getUserOrders($userId)
    {
        $sql = 'SELECT * FROM oophp_Order Orders
        WHERE userId = ?
        ORDER BY id ASC';

        $orders = $this->findAllSql($sql, [$userId]);
        $orders = array_map(function ($order) {
            $order->id = $order->id;
            $order->userId = $order->userId;
            $order->fullName = $order->fullName;
            $order->cardNumber = $order->cardNumber;
            $order->expiration = $order->expiration;
            $order->cvv = $order->cvv;
            $order->created = $order->created;
            return $order;
        }, $orders);

        return $orders;
    }



    /**
     * Get order.
     *
     * @param id $orderId.
     *
     * @return object.
     */
    public function getOrder($orderId)
    {
        $order = $this->find("id", $orderId);
        /* Add orderRows to object */
        if ($order) {
            $order->orderRows = $this->getOrderRows($order->id);
        }

        return $order;
    }



    /**
     * Get total order value.
     *
     * @param id $orderId.
     *
     * @return integer.
     */
    public function getOrderTotal($orderId)
    {
        $orderRows = $this->getOrderRows($orderId);
        $total = 0;

        foreach ($orderRows as $orderRow) {
            $total += $orderRow->price;
        }

        return $total;
    }



    /**
     * Create new order.
     *
     * @param id $userId.
     * @param string $fullName.
     * @param integer $cardNumber.
     * @param integer $expiration.
     * @param integer $cvv.
     *
     * @return object.
     */
    public function createOrder($userId, $fullName, $cardNumber, $expiration, $cvv)
    {
        $this->userId = $userId;
        $this->fullName = $fullName;
        $this->cardNumber = $cardNumber;
        $this->expiration = $expiration;
        $this->cvv = $cvv;
        $this->created = date('Y-m-d G:i:s');
        $this->save();
        return $this;
    }



    /**
     * Get all orderRows that belong to an order.
     *
     * @param id $orderId.
     *
     * @return array.
     */
    public function getOrderRows($orderId)
    {
        $sql = 'SELECT * FROM oophp_OrderRow OrderRow
        WHERE orderId = ?
        ORDER BY id ASC';

        return $ordersRows = $this->findAllSql($sql, [$orderId]);
    }
}
