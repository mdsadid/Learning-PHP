<?php

use Core\App;
use Core\Database;

$db = App::retrieve(Database::class);

$notes = $db->query("SELECT * FROM notes WHERE user_id = {$_SESSION['user']['id']} ORDER BY id DESC")->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes'   => $notes,
]);
