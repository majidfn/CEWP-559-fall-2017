<?php

class CategoryController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->getAll();
    }

    /**
     * TODO: 
     * 
     * You can add the rest of the functionality for the Controller HERE
     * OR
     * You can ove the basic functionality to a `BaseController` class and extend the current class from that
     * 
     */
}