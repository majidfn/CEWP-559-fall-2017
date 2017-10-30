<?php

class CategoryModel extends BaseModel
{
    public $id;
    public $name;
    public $description;
    public $price;

    protected $TableName = 'categories';
    protected $ModelName = 'CategoryModel';
}
