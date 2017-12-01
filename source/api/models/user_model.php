<?php

class UserModel extends BaseModel
{
    public $id;
    public $username;
    public $password;
    public $isAdmin;

    protected $TableName = 'users';
    protected $ModelName = 'UserModel';

    public function getUserByUsername($username) 
    {
        $query = "SELECT * FROM {$this->TableName}  WHERE username = '$username' ";
        $result = $this->db_connection->query($query);

        error_log("getUserByUsername SQL: $query");
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);            
        }

        if ($result->num_rows != 1) {
        	throw new Exception('User does not exist', 400);
        }
        
        return $result->fetch_object($this->ModelName);
    }


    public function getUserByToken($token) 
    {
        $query = "SELECT users.id, users.username, users.isAdmin, tokens.token FROM users JOIN tokens ON users.id = tokens.userID WHERE token = '$token' ";
        $result = $this->db_connection->query($query);

        error_log("getUserByToken SQL: $query");
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);            
        }

        if ($result->num_rows != 1) {
            throw new Exception('User does not exist', 400);
        }
        
        return $result->fetch_object($this->ModelName);
    }



    public function storeToken($userId, $token){
    	$now = date("Y-m-d H:i:s");
		$twoHours = date("Y-m-d H:i:s", strtotime('+2 hours'));

       	$query = "INSERT INTO tokens SET userId = $userId, token = '$token', " . 
       			 "lastUpdateDateTime = '$now' ,  ". 
       			 "expirationDateTime = '$twoHours'  ";

       	error_log($query);

        $result = $this->db_connection->query($query);
        
        if (!$result) {
            throw new Exception("Database error: {$this->db_connection->error}", 500);
        }    	
    }

    public function verifyToken($token) {

        $query = "SELECT * FROM tokens WHERE token = '{$token}' AND ".
                 "expirationDateTime > NOW()";

        error_log($query);

        $result = $this->db_connection->query($query);

        if ($result->num_rows != 1) {
            return false;
        }

        return true;
    }
}

    