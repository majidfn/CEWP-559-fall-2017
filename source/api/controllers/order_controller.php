<?php

class OrderController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function newOrder($userId, $cart) {
    	// inside of  $cart: 
    	// array('items' => $items, 'total' => $total);

    	$order_data = array('userId' => $userId, 'total' => $cart['total']);

    	return $this->model->create($order_data);
    }

    public function createOrderItems($orderId, $cart) {
    	foreach($cart['items'] as $key => $cartItem) {
    		$this->model->insertOrderItem($orderId, $cartItem->id);
    	}
    }

}