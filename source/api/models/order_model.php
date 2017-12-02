<?php

class OrderModel extends BaseModel
{
    public $id;
    public $userId;
    public $total;

    protected $TableName = 'orders';
    protected $ModelName = 'OrderModel';


    public function insertOrderItem($orderId, $itemId){
        $query = "INSERT INTO order_items (orderId, itemId) VALUES ($orderId, $itemId)";

        error_log("Query: $query");

        $result = $this->db_connection->query($query);
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);
        }
    }
}