<?php

use Core\Authenticator;
use Core\Session;
use Http\Requests\LoginRequest;

$email    = $_POST['email'];
$password = $_POST['password'];

Session::flash('old', [
    'email' => $email,
]);

$request = new LoginRequest();
$data    = compact('email', 'password');

if (!$request->validate($data)) {
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
