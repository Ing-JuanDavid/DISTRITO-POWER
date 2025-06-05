<?php

use Core\Response;

$links = require base_path('links.php');

view('logIn/logIn.view.php', [
    'alert' => Response::getAlert(),
    'links' => $links
]);