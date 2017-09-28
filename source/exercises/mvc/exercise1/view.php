<?php

class View
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
	
    public function output(){
        return '<p><a href="index.php?action=clicked">' . $this->model->string . "</a></p>";
    }
}