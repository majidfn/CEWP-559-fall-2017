<?php

$dbh = new PDO('mysql:host=mysql;dbname=CCE_PHPMySQL2', 'root', 'root');
foreach($dbh->query('SELECT * from items') as $row) {
    printf ("%d - %s (%s)\n<br/>", $row[0], $row[1], $row[2]);
}

$dbh = null;
