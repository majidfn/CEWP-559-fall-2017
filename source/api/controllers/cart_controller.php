<?php

class CartController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function addItem($userId, $payload){
		if (!array_key_exists('itemId', $payload)) {
            throw new Exception('`itemId` should be provided!', 400);
        }

        $this->model->addItem($userId, $payload->itemId);

        return true;
    }

    public function getCart($userId){

    	$items = $this->model->getCartItems($userId);

    	$total = $this->model->getCartTotal($userId);

    	return array('items' => $items, 'total' => $total);
    }

    public function emptyCart($userId) {
        $this->model->emptyCart($userId);
    }

}