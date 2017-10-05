<?php

class IndexView
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
	
    public function output(){

		$title = $this->model->title;
		$description = $this->model->description;

    	require_once __DIR__. '/../templates/template.php';
    }
}