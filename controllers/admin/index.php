<?php 
use Core\Response;
use models\MembershipType;
use models\Pay;
use models\User;

requireRole('admin');

$links = require base_path('links.php');

view('admin/dashboard.view.php',[
    'links' => $links,
    'users' => User::getUsers(),
    'mems' => MembershipType::getMems(),
    'members' => Pay::getMembers(),
    'alert' => Response::getAlert()
]); 