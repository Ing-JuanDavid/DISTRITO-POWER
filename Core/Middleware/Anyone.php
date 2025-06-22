<?php

namespace Core\Middleware;

use Core\Services\AuthService;

class Anyone
{
    public function handle()
    {

        if(! getFromSession('user')) {
            AuthService::chekKeepSession();
        }
    }
}