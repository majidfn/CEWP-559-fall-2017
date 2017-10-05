<?php

class ItemController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getAll(){
        $this->model->getItems();
    }
}