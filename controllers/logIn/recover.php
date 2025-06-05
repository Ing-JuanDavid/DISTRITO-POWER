<?php

use Core\Response;

$links = require base_path('links.php');

view('logIn/recover.view.php', [
    'alert' => Response::getAlert(),
    'links' => $links
]);