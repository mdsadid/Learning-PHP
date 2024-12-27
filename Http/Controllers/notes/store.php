<?php

use Core\App;
use Core\Database;
use Http\Requests\NoteRequest;

$body = $_POST['body'];

NoteRequest::validate(
    compact('body')
);

$db = App::retrieve(Database::class);

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    'body'    => $body,
    'user_id' => $_SESSION['user']['id'],
]);

redirect('/notes');
