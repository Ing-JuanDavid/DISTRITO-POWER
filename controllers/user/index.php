<?php

use Core\Response;
use models\Membership;
use models\Pay;
use models\User;

$links = require base_path('links.php');

$user = User::findUserById($_SESSION['userId'] ?? null);
$asists = Membership::getAsistsByUSerId($_SESSION['userId'] ?? null);
$pays = Pay::getPaysByUserId($_SESSION['userId'] ?? null);


view('user/dashboard.php',  [
    'links' => $links,
    'user' => $user,
    'membership' => Membership::findByEmail($user->__get('email')),
    'asists' => stringToDate($asists, 'asistDate'),
    'pays' => stringToDate($pays, 'pay_date'),
    'alert' => Response::getAlert()
]);