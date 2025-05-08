<?php

use Core\Router;

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'helper/functions.php';


$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST') {
    $_method = $_POST['_method'];
    $method = ($method == $_method) ? $method : $_method;
}

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

spl_autoload_register(function($class) {
    $class = str_replace('\\','/',$class);
    $classPath = base_path($class . '.php');
    if(file_exists($classPath)) {
        require $classPath;
    }
    else dd('La clase' . $class . ' no existe en la ruta ' .  $classPath);
    
});

require base_path('bootstrapt.php');

$router = new Router();
require base_path('routes.php');
$router->route($uri, $method);
