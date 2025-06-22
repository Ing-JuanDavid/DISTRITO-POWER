<?php

use Core\Response;

$user = getFromSession('temp_user');

view('logIn/keepSession.view.php', [
    'user' => $user,
    'alert' => Response::getAlert()
]);
