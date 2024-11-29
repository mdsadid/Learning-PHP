<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email    = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (Validator::required($email)) {
    $errors['email'] = 'The email field is required';
}

if (Validator::required($password)) {
    $errors['password'] = 'The password field is required';
}

if (!empty($errors)) {
    view('login/index.view.php', [
        'errors' => $errors
    ]);
} else {
    $db   = App::retrieve(Database::class);
    $user = $db->query('SELECT * FROM users WHERE email = :email', [
        'email' => $email
    ])->first();

    if (!$user) {
        view('login/index.view.php', [
            'errors' => [
                'email' => 'There is no user with this email'
            ]
        ]);

        die();
    }

    if (!password_verify($password, $user['password'])) {
        view('login/index.view.php', [
            'errors' => [
                'password' => 'The password is incorrect'
            ]
        ]);

        die();
    }

    // mark the user as logged-in
    $_SESSION['user'] = [
        'email' => $email,
    ];

    session_regenerate_id(true);

    header('Location: /');
    exit();
}
