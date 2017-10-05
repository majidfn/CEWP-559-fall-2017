<?php

class IndexController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
}