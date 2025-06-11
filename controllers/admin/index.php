<?php 
use Core\Response;
use models\Membership;
use models\MembershipType;
use models\Pay;
use models\User;

$links = require base_path('links.php');

$pays = array_map(function ($pay) {
    $pay['payDate'] = stringToDate($pay['payDate']);
    return $pay;
}, Pay::getPays());


$payDates = Pay::getMonths($pays);

$users = User::getUsers();
$members = Membership::getMembers();
$asists = Membership::getAsistToday();

$stats = [
    'users' => count_anything($users, 'rol', 'user'),
    'active_mems' => count_anything($members, 'status', 'activa'),
    'pays_month' => count_current_month($pays, 'payDate'),
    'asists_today' => sizeof($asists)
];


view('admin/dashboard.view.php',[
    'links' => $links,
    'users' => $users,
    'mems' => MembershipType::getMems(),
    'members' => $members,
    'pays' => $pays,
    'payDates' => $payDates,
    'alert' => Response::getAlert(),
    'stats' => $stats
]); 