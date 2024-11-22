<?php

$router->get('/', 'controllers/home.php');
$router->get('/about', 'controllers/about.php');

$router->group(['middleware' => 'auth'], function ($router) {
    $router->get('/notes', 'controllers/notes/index.php');
    $router->get('/notes/create', 'controllers/notes/create.php');
    $router->post('/notes', 'controllers/notes/store.php');
    $router->get('/note', 'controllers/notes/show.php');
    $router->get('/notes/edit', 'controllers/notes/edit.php');
    $router->patch('/notes', 'controllers/notes/update.php');
    $router->delete('/note', 'controllers/notes/destroy.php');
});

$router->get('/contact', 'controllers/contact.php');

$router->group(['middleware' => 'guest'], function ($router) {
    $router->get('/register', 'controllers/registration/index.php');
    $router->post('/register', 'controllers/registration/store.php');
});
