<?php

use Core\App;
use Core\Database;
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
