<?php

class CategoryModel extends BaseModel
{
    public $id;
    public $name;
    public $description;
    public $price;

    public $_data;

    protected $TableName = 'categories';
    protected $ModelName = 'CategoryModel';
}
