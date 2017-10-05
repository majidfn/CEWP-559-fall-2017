<?php

class ItemView
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
	
    public function output(){
        $data = $this->model->_data;
         
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}