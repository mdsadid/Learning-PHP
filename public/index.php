<?php

session_start();

use Core\Router;

const BASE_PATH = __DIR__ . '/../' ;

function base_path($path): string
{
    return BASE_PATH . $path;
}

spl_autoload_register(function ($class) {
    $qualifiedClassName = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("$qualifiedClassName.php");
});

require base_path('functions.php');
require base_path('bootstrap.php');

$router = new Router();

require base_path('routes.php');

$uri    = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
