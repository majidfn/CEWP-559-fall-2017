<?php

class AboutView
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
	
    public function output(){
        return $this->model->title . ': '. $this->model->description;
    }
}