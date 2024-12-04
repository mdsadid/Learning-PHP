<?php

use Core\Response;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

#[NoReturn] function abort($code = Response::NOT_FOUND): void
{
    http_response_code($code);

    view("errors/$code.view.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN): void
{
    if (!$condition) abort($status);
}

function view($path, $attributes = []): void
{
    $file = base_path("views/$path");

    if (!file_exists($file)) {
        echo "View $path does not exist";
        die();
    }

    extract($attributes);
    require $file;
}

function asset($path): string
{
    $scheme       = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host         = $_SERVER['HTTP_HOST'];
    $sanitizePath = ltrim($path, '/');

    return "$scheme://$host/$sanitizePath";
}

#[NoReturn] function redirect($path): void
{
    header("Location: $path");
    die();
}
