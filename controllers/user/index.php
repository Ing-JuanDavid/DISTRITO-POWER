<?php 

$links = require base_path('links.php');

view('user/dashboard.php',  [
    'links' => $links,
    'user' => $_SESSION['user'],
]);