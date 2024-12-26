<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Requests\RegistrationRequest;

$email           = $_POST['email'];
$password        = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

RegistrationRequest::validate(
    compact('email', 'password', 'confirmPassword')
);

$db   = App::retrieve(Database::class);
$user = $db->insertAndFetch('users', [
    'email'    => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);

// mark the user as logged-in
(new Authenticator)->login($user);

redirect('/');
