<?php

class ItemController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getAll(){
        $this->model->getAll();
    }

    public function getOne($id){
        $this->model->getOne($id);
    }

    public function create($requestBody){
        // Validating the data inside the JSON
        // We make sure the `title` and `price` are provided

        if(!array_key_exists('name', $jsonPayload)){
            throw new Exception('`name` should be provided!');
        }elseif(!array_key_exists('price', $jsonPayload)){
            throw new Exception('`price` should be provided!');
        }

        $this->model->create($jsonPayload);
    }
}