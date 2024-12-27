<?php

session_start();

use Core\Exceptions\ValidationException;
use Core\Router;
use Core\Session;

const BASE_PATH = __DIR__ . '/../';

function base_path($path): string
{
    return BASE_PATH . $path;
}

require base_path('vendor/autoload.php');
require base_path('functions.php');
require base_path('bootstrap.php');

$router = new Router();

require base_path('routes.php');

$uri    = filter_var(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), FILTER_SANITIZE_URL);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    $router->back();
}

Session::expire();
