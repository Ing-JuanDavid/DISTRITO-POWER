<?php

namespace Core\Middleware;

use Core\Auth;

class User
{
    public function handle()
    {
        if(! isset($_SESSION['user']) || ! isset($_SESSION['rol'])) {
            Auth::recoverSession();
        }

        if ($_SESSION['rol'] !== 'user') {
            abort(403);
        }
    }
}