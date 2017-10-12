<?php

require_once __DIR__.'/loader.php';

$pathParts = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
$resource =  $pathParts[1]; 
$id = $pathParts[2];
$action = $_GET['action'];

$method = $_SERVER['REQUEST_METHOD'];
$requestBody = $_POST;


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

try{
    switch ($resource) {
        case 'items':
        $model = new ItemModel($mysqli);
        $view = new ItemView($model);
        $controller = new ItemController($model);
        
        // Update is when user is POSTing to /items/:ID
        if($method == 'POST' && !empty($id)){
            
        // Create a new entry is when POST to /items/
        }elseif($method == 'POST' && empty($id)){
            $controller->create($requestBody);
            header("Location: http://localhost/api/items");

        }elseif($action == 'newform'){
            echo $view->createNew();

        }elseif($method == 'GET' && !empty($id)){
            $controller->getOne($id);

        }elseif($method == 'GET' && empty($id)){
            $controller->getAll();
            echo $view->showAll();
        }
        
        break;

        default:
        break;
    }
}catch(Exception $e){
    http_response_code($e->getCode());
    echo $e->getMessage();
}
    