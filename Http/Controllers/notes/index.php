<?php

use Core\App;
use Core\Database;

$db         = App::retrieve(Database::class);
$authUserId = $_SESSION['user']['id'];
$notes      = $db->query("SELECT * FROM notes WHERE user_id = $authUserId ORDER BY id DESC")->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes'   => $notes,
]);
