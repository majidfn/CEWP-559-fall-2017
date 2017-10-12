<?php

class BaseModel
{
    
    protected $db_connection;
    
    function __construct($connection = null){
        if(!empty($connection)){
            $this->db_connection = $connection;
        }
    }
    
    
    public function getAll(){
        // Your code here
    }

    public function getOne($id){
        // Your code here
    }
}