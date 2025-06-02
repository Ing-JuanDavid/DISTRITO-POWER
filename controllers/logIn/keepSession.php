<?php

use Core\Response;

$user = $_SESSION['temp_user'] ?? null;

view('logIn/keepSession.view.php', [
    'user' => $user,
    'alert' => Response::getAlert()
]);
