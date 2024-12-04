<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db            = App::retrieve(Database::class);
$currentUserId = 3;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_POST['id']
])->firstOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (Validator::required($_POST['body'])) {
    $errors['body'] = 'Body is required';
}

if (Validator::max($_POST['body'], 1000)) {
    $errors['body'] = 'The body cannot be more than 1,000 characters';
}

if (!empty($errors)) {
    view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'note'    => $note,
        'errors'  => $errors,
    ]);
} else {
    $db->query('UPDATE notes SET body = :body WHERE id = :id', [
        'body' => $_POST['body'],
        'id'   => $note['id']
    ]);

    redirect('/notes');
}
