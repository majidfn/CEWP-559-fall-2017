<?php
function connect(){
    $mysqli = new mysqli('mysql', 'root', 'root', 'CCE_PHPMySQL2', '3306');
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    return $mysqli;
}

function fetch_all(){
    $mysqli = connect();

    $query = 'SELECT ID, Name, Price FROM items';
    $result = $mysqli->query($query);

    if (!$result) {
        printf("Error: %s\n", $mysqli->error);
        return;
    }
    
    while ($row = $result->fetch_row()) {
        printf ("%d - %s (%s)\n<br/>", $row[0], $row[1], $row[2]);
    }
    
    /* free result set */
    $result->close();

    /* close connection */
    $mysqli->close();
}

echo 'Fetching all the records.... :<br/>';
fetch_all();