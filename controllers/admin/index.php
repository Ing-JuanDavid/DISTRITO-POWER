<?php 
use Core\App;
use Core\Response;
use models\MembershipType;
use models\User;

requireRole('admin');

$conn = App::container()->resolve('Core/Database');

view('admin/dashboard.view.php',[
    'users' => User::getUsers($conn),
    'mems' => MembershipType::getMems($conn),
    'alert' => Response::getAlert()
]); 