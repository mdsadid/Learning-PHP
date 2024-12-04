<?php

use Core\Authenticator;
use Http\Requests\LoginRequest;

$email    = $_POST['email'];
$password = $_POST['password'];

$request = new LoginRequest();

if (!$request->validate($email, $password)) {
    view('login/index.view.php', [
        'errors' => $request->errors()
    ]);

    die();
}

if ((new Authenticator)->attempt($email, $password)) {
    redirect('/');
}

view('login/index.view.php', [
    'errors' => [
        'email' => 'No matching account found for this email and password'
    ]
]);
