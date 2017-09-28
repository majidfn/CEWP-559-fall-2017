<?php

require_once __DIR__.'/model.php';
require_once __DIR__.'/view.php';
require_once __DIR__.'/controller.php';

$model = new Model();
$controller = new Controller($model);
$view = new View($model);

echo $view->output();