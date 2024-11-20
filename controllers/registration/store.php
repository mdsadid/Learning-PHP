<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email    = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (Validator::required($email)) {
    $errors['email'] = 'The email field is required';
} elseif (!Validator::email($email)) {
    $errors['email'] = 'The email must be a valid email address';
} elseif (!Validator::unique('users', 'email', $email)) {
    $errors['email'] = 'The email has already been taken';
}

if (Validator::required($password)) {
    $errors['password'] = 'The password field is required';
} elseif (Validator::min($password, 5)) {
    $errors['password'] = 'The password must be at least 5 characters';
} elseif (Validator::max($password, 10)) {
    $errors['password'] = 'The password must be at most 10 characters';
}

if (!empty($errors)) {
    view('registration/index.view.php', [
        'errors' => $errors
    ]);
} else {
    $db = App::retrieve(Database::class);

    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    // mark the user as logged-in
    $_SESSION['user'] = [
        'email' => $email,
    ];

    header('Location: /');
    exit();
}
