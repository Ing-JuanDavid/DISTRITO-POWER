<?php

$links = require base_path('links.php');

view('home.view.php', [
    'links' => $links
]);