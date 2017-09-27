<?php

//
// Exercise - 1:
// Define an Item class with the attributes of: ID, Name and Price
//
// Exercise - 2:
// Use mysqli_result::fetch_object to fetch the result set in to an instance of that class
// http://php.net/manual/en/mysqli-result.fetch-object.php
// 
// Exercise - 3:
// Use xdebug for better debugging capabilities

class Item {
    public $ID;
    public $Name;
    public $Price;
}

$mysqli = new mysqli('mysql', 'root', 'root', 'CCE_PHPMySQL2', '3306');

if ($mysqli->connect_errno) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = 'SELECT ID, Name, Price FROM items';
$result = $mysqli->query($query);

if (!$result) {
    printf("Error: %s\n", $mysqli->error);
    return;
}

while ($row = $result->fetch_row()) {
    printf ("%d - %s (%s)\n<br/>", $row[0], $row[1], $row[2]);
}


// free result set
$result->close();

// close connection
$mysqli->close();