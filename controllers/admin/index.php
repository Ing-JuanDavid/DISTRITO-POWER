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
    'users' => countAnything($users, 'rol', 'user'),
    'active_mems' => countAnything($members, 'status', 'activa'),
    'pays_month' => countCurrentMonth($pays, 'payDate'),
    'asists_today' => sizeof($asists)
];

$temPays = array_map(function($pay){
    $pay['payDate'] = date('F', strtotime($pay['payDate']));
    return $pay['payDate'];
}, $pays);

$tempMembers = array_map(function($member){
    $member['start_date'] = date('F', strtotime($member['start_date']));
    return $member['start_date'];
}, $members);


$chartPays = array_reverse(array_count_values($temPays));
$chartMems = array_reverse(array_count_values($tempMembers));


view('admin/dashboard.view.php',[
    'links' => $links,
    'users' => $users,
    'mems' => MembershipType::getMems(),
    'members' => $members,
    'pays' => $pays,
    'payDates' => $payDates,
    'alert' => Response::getAlert(),
    'stats' => $stats,

    'chartPays' => $chartPays,
    'chartMems' => $chartMems
]); 