<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db     = App::retrieve(Database::class);
$errors = [];

if (Validator::required($_POST['body'])) {
    $errors['body'] = 'Body is required';
}

if (Validator::max($_POST['body'], 1000)) {
    $errors['body'] = 'The body cannot be more than 1,000 characters';
}

if (!empty($errors)) {
    view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors'  => $errors,
    ]);
} else {
    $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
        'body'    => $_POST['body'],
        'user_id' => 3,
    ]);

    header('Location: /notes');
    exit();
}
