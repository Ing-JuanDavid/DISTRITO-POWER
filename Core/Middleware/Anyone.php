<?php

namespace Core\Middleware;

use Core\Services\AuthService;

class Anyone
{
    public function handle()
    {

        if(!isset($_SESSION['user'])) {
            AuthService::chekKeepSession();
        }
    }
}