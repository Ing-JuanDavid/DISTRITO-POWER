<?php

use Core\Response;
use models\Membership;
use models\Pay;
use models\User;

$links = require base_path('links.php');

$user = User::findUserById($_SESSION['userId'] ?? null);

$asists = array_map(function($asist) {
    $asist['asist_date'] = stringToDate($asist['asist_date']);
    return $asist;
}, Membership::getAsistsByUSerId($_SESSION['userId']));

$pays = array_map(function($pay) {
    $pay['pay_date'] = stringToDate($pay['pay_date']);
    return $pay;
}, Pay::getPaysByUserId($_SESSION['userId']));

view('user/dashboard.php',  [
    'links' => $links,
    'user' => $user,
    'membership' => Membership::findByEmail($user->__get('email')),
    'asists' => $asists,
    'pays' => $pays,
    'alert' => Response::getAlert(),
    'count_asists' => countCurrentMonth($asists, 'asist_date')
]);