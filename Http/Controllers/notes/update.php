<?php

use Core\App;
use Core\Database;
use Http\Requests\NoteRequest;

$id   = $_POST['id'];
$body = $_POST['body'];

NoteRequest::validate(
    compact('body')
);

$db = App::retrieve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $id
])->firstOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'body' => $body,
    'id'   => $id
]);

redirect("/note?id=$id");
