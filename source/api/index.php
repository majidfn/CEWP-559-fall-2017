<?php

require_once __DIR__ . '/loader.php';


error_log('API is starting!');

/**
 * Path Parts:
 * 
 * When user specifies the path as something like:
 *  POST http://localhost/api/items/4/image
 * the following piece of code work as below:
 * 
 * $pathparts will be an arrya of : array('items', '1', 'image')
 * where:
 * items: is the `resource`
 * 1: is the `id`
 * image: is `subresource`
 * POST: is the `method`
 * 
 */

$baseURL = strtok($_SERVER["REQUEST_URI"],'?');

$api = strtok($baseURL, '/');
$resource = strtok('/');
$id = strtok('/');
$subresource = strtok('/');

$method = $_SERVER['REQUEST_METHOD'];
$requestBody = file_get_contents('php://input');
$requestJSON = json_decode($requestBody);
$requestHeaders = getallheaders();

$filters = $_GET;
$hasFilters = !empty($_GET);


//
// Database Connection
//
$dbhost = $_ENV['RDS_HOSTNAME'];
$dbport = $_ENV['RDS_PORT'];
$dbname = $_ENV['RDS_DB_NAME'];
$username = $_ENV['RDS_USERNAME'];
$password = $_ENV['RDS_PASSWORD'];

$mysqli = new mysqli($dbhost, $username, $password, $dbname, $dbport);
if ($mysqli->connect_errno) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


$userModel = new UserModel($mysqli);
$userController = new UserController($userModel);


try {
    // Make sure if we have any JSON data as input, it's valid, otherwise throw an exception
    if (!empty($requestBody) && json_last_error() != 0){
        throw new Exception(json_last_error_msg(), 400);
    }

    switch ($resource) {
        case 'items':

        // $userController->verify($requestHeaders);


        $model = new ItemModel($mysqli);
        $controller = new ItemController($model);
        
        if ($method == 'POST' && !empty($id) && $subresource == 'image') {
            $data = $controller->upload($id, $_FILES['new_item_image']);
            
        } elseif ($method == 'POST') {
            $userController->isAdmin($requestHeaders);
            $data = $controller->create($requestJSON);
            
        } elseif ($method == 'GET' && !empty($id)) {
            $data = $controller->getOne($id);
            
        } elseif ($method == 'GET' && $hasFilters) {
            $data = $controller->getAllWithFilters($filters);
            
        } elseif ($method == 'GET') {
            $data = $controller->getAll();
            
        } elseif ($method == 'PUT' && !empty($id)) {
            $data = $controller->update($id, $requestJSON);
            
        } elseif ($method == 'DELETE' && !empty($id)) {
            $controller->delete($id);
            // TODO: Remove this after implementing it
            // throw new Exception('Handler for DELETE method has NOT been implemented yet!', 501); // 501: Not Implemented!
        }
        
        break;
        
        case 'categories':
        $model = new CategoryModel($mysqli);
        $controller = new CategoryController($model);
        
        if ($method == 'GET' && empty($id)) {
            $data = $controller->getAll();
        }
        
        break;


        case 'users':
        if ($method == 'POST') {
            $data = $userController->create($requestJSON);   
        }
        break;


        case 'login':
        if ($method == 'POST') {
            $data = $userController->login($requestJSON);   
        }
        break;        

        case 'cart':
        $user = $userController->getUserByToken($requestHeaders);
        
        $model = new CartModel($mysqli);
        $controller = new CartController($model);

        if ($method == 'POST') {
            $controller->addItem($user->id, $requestJSON);
        }elseif ($method == 'GET') {
            $data = $controller->getCart($user->id);
        }
        break;

        case 'payment':
        $user = $userController->getUserByToken($requestHeaders);

        $cart_model = new CartModel($mysqli);
        $cart_controller = new CartController($cart_model);

        $order_model = new OrderModel($mysqli);
        $order_controller = new OrderController($order_model);

        if ($method == 'POST') {
            // TODO: The rest of the Payment code should go here!
            
            $cart = $cart_controller->getCart($user->id);
            $order = $order_controller->newOrder($user->id, $cart);
            $order_controller->createOrderItems($order->id, $cart);
            // empty the cart for the user
            $cart_controller->emptyCart($user->id);
        }

        break;

        
        default:
        throw new Exception("$method is not implemented on: $baseURL ", 501); // 501: Not Implemented!
        break;
    }
    
} catch (Exception $e) {
    $data = array('error' => $e->getMessage());
    $code = $e->getCode();
    $code = !empty($code) ? $code : 400;
    http_response_code($code);
}

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');

echo json_encode($data, JSON_PRETTY_PRINT);