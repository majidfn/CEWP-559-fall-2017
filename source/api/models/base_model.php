<?php
/**
 * BaseModel to include the Basic functionality for each Model class
 */

/**
 * BaseModel provides the basic functionality of the Models
 * All other models will inherit from this BaseModel class to have these basic functionalities.$_COOKIE
 * Inheritance is used here to avoid having duplicate codes
 */
class BaseModel
{
    
    // $TableName includes the table name that Model will interact with
    // protected $TableName;
    // $ModelName includes the name of the class that will be instantiated when rerieving records from database
    // protected $ModelName;

    // Holds the connection to the database
    protected $db_connection;
    
    function __construct($connection = null)
    {
        if (!empty($connection)) {
            $this->db_connection = $connection;
        }
    }
   
    
    /**
     * getFiltered will retrieve all the records from the databse from $TableName based on the JOIN clause and WHERE Clause specified
     */
    public function getFiltered($join_clause = '', $where_clause = '')
    {
        $items = array();
        $query = "SELECT * FROM {$this->TableName} {$join_clause} {$where_clause}";

        error_log("QUERY: $query");
        
        $result = $this->db_connection->query($query);

        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);
        }
        
        while ($item = $result->fetch_object($this->ModelName)) {
            $items[] = $item;
        }

        return $items;
    }
    
    /**
     * getAll will retrieve all the records from the databse from $TableName
     */
    public function getAll()
    {
        $items = array();
        $query = "SELECT * FROM {$this->TableName}";
        $result = $this->db_connection->query($query);

        error_log("Generated Query is: $query");
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);
        }
        
        while ($item = $result->fetch_object($this->ModelName)) {
            $items[] = $item;
        }

        return $items;
    }

    /**
     * getOne retrieves one record from the table $TableName based on the id specified
     *
     * @param int $id id of the record to be fetched from the databse
     */
    public function getOne($id)
    {
        $query = "SELECT * FROM {$this->TableName}  WHERE id = $id";
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);            
        }
        
        $item = $result->fetch_object($this->ModelName);
        return $item;
    }


    
    /**
     * create save the payload as a new Item in to the Database table $TableName
     *
     * Eventually we need an insert statement like below:
     *    INSERT INTO items SET name='item_name', description='item description', price='34.6'
     * to achieve that we loop through the fields from the passed object and create an array of key = value
     * we eventually use implode to concat the elements of that array with , so the overal statement would look like
     * the requires SQL statement.
     *
     * @param object payload The info for the new record to be inserted in to the $TableName
     */
    public function create($payload)
    {
        
        
        $fields = array();
        foreach ($payload as $field => $val) {
            $fields[] = "$field = '$val'";
        }

        $setStatement = implode(', ', $fields);
        $query = "INSERT INTO {$this->TableName} SET $setStatement";

        error_log("Insert SQL: $query");

        $result = $this->db_connection->query($query);
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);
        }
        
        $insertedId = $this->db_connection->insert_id;
        return $this->getOne($insertedId);
    }

    // TODO: Update the code here to accomodate `create`
    
    // TODO: Update the code here to accomodate `delete`

    protected function updateFieldById($id, $field, $value)
    {
        $query = "UPDATE {$this->TableName} SET {$field} = '{$value}' WHERE id = $id";
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);
        }

        return;
    }
}
