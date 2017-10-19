<?php

require_once __DIR__.'/models/base_model.php';

// Item
require_once __DIR__.'/models/item_model.php';
require_once __DIR__.'/views/item_view.php';
require_once __DIR__.'/controllers/item_controller.php';

// Category
require_once __DIR__.'/models/category_model.php';
require_once __DIR__.'/controllers/category_controller.php';


// spl_autoload_register(function ($class_name) {

//     preg_match_all('/[A-Z][a-z]+/', $class_name, $matches);

//     $paths = $matches[0];
//     $paths = array_values(array_filter($paths));
//     $paths = array_map('strtolower', $paths);

//     include __dir__."/{$paths[1]}s/{$paths[0]}_{$paths[1]}.php";
// });
