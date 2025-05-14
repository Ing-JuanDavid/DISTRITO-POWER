<?php

use Core\Response;
use models\MembershipType;


requireRole('admin');

$links = require base_path('links.php');

view('admin/pays.view.php', [
    'links' => $links,
    'mems' => MembershipType::getMems(),
    'alert' => Response::getAlert(),
    
]);