<?php

use Core\Response;
use models\Membership;
use models\MembershipType;
use models\Pay;

requireRole('admin');

$links = require base_path('links.php');

view('admin/pays.view.php', [
    'links' => $links,
    'mems' => MembershipType::getMems(),
    'alert' => Response::getAlert(),
    'members' => Pay::getMembers()
]);