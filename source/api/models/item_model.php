<?php

class ItemModel
{
    public $ID;
    public $Name;
    public $Description;
    public $Price;

    public $_data;
    
    private $db_connection;
    
    function __construct($connection = null){
        if(!empty($connection)){
            $this->db_connection = $connection;
        }
    }

    public function getAll(){
        $items = array();
        $query = 'SELECT ID, Name, Price, Description FROM items';
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }
        
        while ($item = $result->fetch_object('ItemModel')) {
            $items[] = $item;
        }

        $this->_data = $items;
    }

    public function getOne($id){
        $query = 'SELECT ID, Name, Price, Description FROM items WHERE ID = ' . $id;
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }
        
        $item = $result->fetch_object('ItemModel');

        $this->_data = $item;
    }

    //
    // Save the payload as a new Item in to the Database
    // 
    public function create($payload){
        // Using sprintf to format the query in a nicer way
        $query = sprintf("INSERT INTO items (Name, Description, Price) VALUES ('%s', '%s', '%s')", 
            $payload->name, 
            $payload->description, 
            $payload->price);

        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }

        $insertedId = $this->db_connection->insert_id;
        return $this->getOne($insertedId);
    }


}