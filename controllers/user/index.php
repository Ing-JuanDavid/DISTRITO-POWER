<?php

use Core\Response;
use models\Membership;
use models\Pay;
use models\User;

$links = require base_path('links.php');

$user = User::findUserByEmail($_SESSION['user'] ?? null);
$asists = Membership::getAsistsByUSerId($user->__get('userId'));
$pays = Pay::getPaysByUserId($user->__get('userId'));


view('user/dashboard.php',  [
    'links' => $links,
    'user' => $user,
    'membership' => Membership::findByEmail($user->__get('email')),
    'asists' => stringToDate($asists, 'asistDate'),
    'pays' => stringToDate($pays, 'payDate'),
    'alert' => Response::getAlert()
]);