<?php

class Controller
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function click(){
        $this->model->string = 'Clicked!';
    }
}