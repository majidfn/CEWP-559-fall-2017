<?php

require_once __DIR__.'/loader.php';

$routes = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
$path =  $routes[1]; 


// 
// Database Connection
//
$mysqli = new mysqli('mysql', 'root', 'root', 'CCE_PHPMySQL2', '3306');
if ($mysqli->connect_errno) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

switch ($path) {
    case 'items':
        $model = new ItemModel($mysqli);
        $view = new ItemView($model);
        $controller = new ItemController($model);

        $controller->getAll();
        echo $view->output();
        break;
    
    default:
        break;
}
