<?php

use models\Pay;

requireRole('admin');

view('admin/pays.view.php', [
    'members' => Pay::getMembers()
]);