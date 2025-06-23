<?php 
use Core\Response;
use models\Membership;
use models\MembershipType;
use models\Pay;
use models\User;

$links = require base_path('links.php');



$pays = array_map(function ($pay) {
    $pay['pay_date'] = stringToDate($pay['pay_date']);
    return $pay;
}, Pay::getPays());


$payMonths = Pay::getMonths($pays);



$users = User::getUsers();
$members = Membership::getMembers();
$asists = Membership::getAsistToday();

$stats = [
    'users' => countAnything($users, 'rol', 'user'),
    'active_mems' => countAnything($members, 'status', 'activa'),
    'pays_month' => countCurrentMonth($pays, 'pay_date'),
    'asists_today' => sizeof($asists)
];

$memberMonths = array_map(function($member){
    $member['start_date'] = date('F', strtotime($member['start_date']));
    return $member['start_date'];
}, $members);

$chartPays = Pay::getTotalByMonths($pays);
$labels = monthsTransurred();
$memsData = Membership::totalForeachMonth($labels, $memberMonths);


view('admin/dashboard.view.php',[
    'links' => $links,
    'users' => $users,
    'mems' => MembershipType::getMems(),
    'members' => $members,
    'pays' => $pays,
    'payMonths' => $payMonths,
    'alert' => Response::getAlert(),
    'stats' => $stats,
    'chartPays' => $chartPays,
    'chartMems' => $labels,
    'memsData' => $memsData
]); 