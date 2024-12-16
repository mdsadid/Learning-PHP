<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Requests\NoteRequest;

$body = $_POST['body'];
$data = compact('body');

Session::flash('old', $data);

$request = new NoteRequest();

if (!$request->validate($data)) {
    Session::flash('errors', $request->errors());

    redirect('/notes/create');
}

$db         = App::retrieve(Database::class);
$authUserId = $_SESSION['user']['id'];

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    'body'    => $body,
    'user_id' => $authUserId,
]);

redirect('/notes');
