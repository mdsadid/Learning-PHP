<?php

use Core\Session;

view('login/index.view.php', [
    'errors' => Session::get('errors')
]);
