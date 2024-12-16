<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Http\Requests\RegistrationRequest;

$email           = $_POST['email'];
$password        = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

Session::flash('old', [
    'email' => $email,
]);

$request = new RegistrationRequest();
$data    = compact('email', 'password', 'confirmPassword');

if (!$request->validate($data)) {
    Session::flash('errors', $request->errors());

    redirect('/register');
}

$db = App::retrieve(Database::class);

$db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
    'email'    => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);

// mark the user as logged-in
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->first();

(new Authenticator)->login($user);

redirect('/');
