<?php

require_once __DIR__.'/loader.php';


$paths = explode('/', $_SERVER['REQUEST_URI']);
// var_dump($paths);
$page = $paths[3];

if(empty($page)){
    $page = 'index';
}

$routes = array(
    'about' => array('model' => 'AboutModel', 'view' => 'AboutView', 'controller' => 'AboutController'),
    'index' => array('model' => 'IndexModel', 'view' => 'IndexView', 'controller' => 'IndexController')
);

foreach($routes as $key => $components){
    if ($page == $key) {
        $Model = $components['model'];
        $View = $components['view'];
        $Controller = $components['controller'];
        break;
    }
}

if (isset($Model)) {
    $m = new $Model();
    $c = new $Controller($m);
    $v = new $View($m);

    echo $v->output();
}