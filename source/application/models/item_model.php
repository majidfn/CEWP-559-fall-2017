<?php

class ItemModel
{
    public $data;
    private $dao;

    public function __construct($dao){
        $this->dao = $dao;
    }

    public function getItems(){
        $this->data = $this->dao->getItems();
    }
}