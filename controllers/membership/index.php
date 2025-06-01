<?php

use models\MembershipType;


view('memberships.view.php', [
    'links' => require base_path('links.php'),
    'memberships' => MembershipType::getMems(),
]);