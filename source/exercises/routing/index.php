<?php

require_once __DIR__.'/loader.php';

$page = $_GET['page'];

$routes = array(
    'about' => array('model' => 'AboutModel', 'view' => 'AboutView', 'controller' => 'AboutController'),
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