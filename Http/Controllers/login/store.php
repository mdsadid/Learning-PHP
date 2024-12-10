<?php

use Core\Authenticator;
use Core\Session;
use Http\Requests\LoginRequest;

$email    = $_POST['email'];
$password = $_POST['password'];

$request = new LoginRequest();

if (!$request->validate($email, $password)) {
    Session::flash('errors', $request->errors());

    redirect('/login');
}

if ((new Authenticator)->attempt($email, $password)) {
    redirect('/');
}

Session::flash('errors', [
    'email' => 'No matching account found for this email and password'
]);

redirect('/login');
