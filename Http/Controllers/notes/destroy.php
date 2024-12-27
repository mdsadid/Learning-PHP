<?php

use Core\App;
use Core\Database;

$db = App::retrieve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_POST['id']
])->firstOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

$db->query('DELETE FROM notes WHERE id = :id', [
    'id' => $note['id']
]);

redirect('/notes');
