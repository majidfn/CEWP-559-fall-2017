<?php

//
// Try the following code. It will raise an Exception
// 
// Exercise - 1: 
// Handle the Exception using a try/catch block and print out the error message using `getMessage` method
//
// Exercise - 2: 
// Install the required Extension: 
//  - Step 1 : Docker PHP File
//  - Step 2 : php.ini file 


$dbh = new PDO('mysql:host=mysql;dbname=CCE_PHPMySQL2', 'root', 'root');
foreach($dbh->query('SELECT * from items') as $row) {
    printf ("%d - %s (%s)\n<br/>", $row[0], $row[1], $row[2]);
}

$dbh = null;
