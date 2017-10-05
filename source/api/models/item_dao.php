<?php

require_once __DIR__.'/item_object.php';

class ItemDAO{
    private $db_connection;
    
    function __construct($connection){
        $this->db_connection = $connection;
    }
    
    function getItems(){
        $items = array();
        $query = 'SELECT ID, Name, Price, Description FROM items';
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $mysqli->error);
            return;
        }
        
        while ($item = $result->fetch_object('ItemObject')) {
            $items[] = $item;
        }

        return $items;
    }
}