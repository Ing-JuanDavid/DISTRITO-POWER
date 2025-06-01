<?php

namespace Core\Middleware;
use Core\Services\AuthService;

class Admin
{
    public function handle()
    {
        if (! isset($_SESSION['user']) || ! isset($_SESSION['rol'])) {
            if(! AuthService::recoverSession()) abort(403);
        }

        if ($_SESSION['rol'] !== 'admin') {
            abort(403);
        }
    }
}