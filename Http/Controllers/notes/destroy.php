<?php

use Core\App;
use Core\Database;

$db            = App::retrieve(Database::class);
$currentUserId = 3;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_POST['id']
])->firstOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('DELETE FROM notes WHERE id = :id', [
    'id' => $note['id']
]);

header('Location: /notes');
exit();
