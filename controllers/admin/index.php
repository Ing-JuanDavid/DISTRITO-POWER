<?php 
use Core\Response;
use models\MembershipType;
use models\Pay;
use models\User;

$links = require base_path('links.php');

$pays = Pay::getPays();

$payDates = Pay::getMonths($pays);

view('admin/dashboard.view.php',[
    'links' => $links,
    'users' => User::getUsers(),
    'mems' => MembershipType::getMems(),
    'members' => Pay::getMembers(),
    'pays' => $pays,
    'payDates' => $payDates,
    'alert' => Response::getAlert()
]); 