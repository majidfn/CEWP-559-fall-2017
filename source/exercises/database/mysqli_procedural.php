<?php

$conn = mysqli_connect('mysql', 'root', 'root', 'CCE_PHPMySQL2');

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$result = mysqli_query($conn, 'SELECT ID, Name, Price FROM items');

if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
    	echo "{$row['ID']} - {$row['Name']} - \"\${$row['Price']}\" <br/>";
    }
}

mysqli_close($conn);