<?php 
use Core\App;
use Core\Response;
use models\MembershipType;
use models\User;

requireRole('admin');

$links = require base_path('links.php');

view('admin/dashboard.view.php',[
    'links' => $links,
    'users' => User::getUsers(),
    'mems' => MembershipType::getMems(),
    'alert' => Response::getAlert()
]); 