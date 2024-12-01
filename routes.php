<?php

$router->get('/', 'home.php');
$router->get('/about', 'about.php');

$router->group(['middleware' => 'auth'], function ($router) {
    $router->get('/notes', 'notes/index.php');
    $router->get('/notes/create', 'notes/create.php');
    $router->post('/notes', 'notes/store.php');
    $router->get('/note', 'notes/show.php');
    $router->get('/notes/edit', 'notes/edit.php');
    $router->patch('/notes', 'notes/update.php');
    $router->delete('/note', 'notes/destroy.php');
});

$router->get('/contact', 'contact.php');

$router->group(['middleware' => 'guest'], function ($router) {
    $router->get('/login', 'login/index.php');
    $router->post('/login', 'login/store.php');
});

$router->delete('/logout', 'login/destroy.php')->only('auth');

$router->group(['middleware' => 'guest'], function ($router) {
    $router->get('/register', 'registration/index.php');
    $router->post('/register', 'registration/store.php');
});
