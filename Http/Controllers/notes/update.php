<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Requests\NoteRequest;

$id   = $_POST['id'];
$body = $_POST['body'];
$data = compact('body');

Session::flash('old', $data);

$request = new NoteRequest();

if (!$request->validate($data)) {
    Session::flash('errors', $request->errors());

    redirect("/notes/edit?id=$id");
}

$db         = App::retrieve(Database::class);
$authUserId = $_SESSION['user']['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $id
])->firstOrFail();

authorize($note['user_id'] === $authUserId);

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'body' => $body,
    'id'   => $id
]);

redirect("/note?id=$id");
