<?php

class ItemModel
{
    public $ID;
    public $Name;
    public $Description;
    public $Price;

    public $data;
    
    private $db_connection;
    
    function __construct($connection = null){
        if(!empty($connection)){
            $this->db_connection = $connection;
        }
    }

    public function getItems(){
        $items = array();
        $query = 'SELECT ID, Name, Price, Description FROM items';
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $mysqli->error);
            return;
        }
        
        while ($item = $result->fetch_object('ItemModel')) {
            $items[] = $item;
        }

        $this->data = $items;
    }    
}