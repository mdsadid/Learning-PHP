<?php

use Core\App;
use Core\Database;

$db = App::retrieve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->firstOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

view('notes/show.view.php', [
    'heading' => 'Note Details',
    'note'    => $note,
]);
