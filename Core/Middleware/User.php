<?php

namespace Core\Middleware;

use Core\Services\AuthService;

class User
{
    public function handle()
    {
        if(! isset($_SESSION['user']) || ! isset($_SESSION['rol'])) {
            AuthService::recoverSession();
        }

        if ($_SESSION['rol'] !== 'user') {
            abort(403);
        }
    }
}