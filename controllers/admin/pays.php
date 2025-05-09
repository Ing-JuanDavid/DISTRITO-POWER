<?php

use Core\Response;
use models\Membership;
use models\MembershipType;
use models\Pay;

requireRole('admin');

view('admin/pays.view.php', [
    'mems' => MembershipType::getMems(),
    'alert' => Response::getAlert(),
    'members' => Pay::getMembers()
]);