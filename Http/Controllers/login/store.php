<?php

use Core\Authenticator;
use Core\Session;
use Http\Requests\LoginRequest;

$email    = $_POST['email'];
$password = $_POST['password'];

LoginRequest::validate(
    compact('email', 'password')
);

$loggedIn = (new Authenticator)->attempt($email, $password);

if (!$loggedIn) {
    Session::flash('errors', [
        'email' => 'No matching account found for this email and password'
    ]);

    redirect('/login');
}

redirect('/');
