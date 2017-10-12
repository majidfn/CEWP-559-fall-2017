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

    public function showAll(){
        $data = $this->model->_data;
        require_once(__DIR__. '/templates/items_view_all.php');
    }
    
    public function createNew() {
        require_once(__DIR__. '/templates/items_create_new_form.php');
    }
}