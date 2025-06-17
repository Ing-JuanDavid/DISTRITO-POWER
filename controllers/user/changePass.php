<?php

use Core\Services\AuthService;

$id = getFromSession('userId');

AuthService::changuePassword($id);