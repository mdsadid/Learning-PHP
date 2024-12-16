<?php

use Core\App;
use Core\Database;

$db         = App::retrieve(Database::class);
$authUserId = $_SESSION['user']['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->firstOrFail();

authorize($note['user_id'] === $authUserId);

view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'note'    => $note,
]);
