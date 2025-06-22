<?php

namespace Core\Middleware;
use Core\Services\AuthService;

class Admin
{
    public function handle()
    {
        if (! getFromSession('user') || ! getFromSession('rol')) {
            if(! AuthService::chekKeepSession()) abort(403);
        }

        if (getFromSession('rol') !== 'admin') abort(403);
    }
}