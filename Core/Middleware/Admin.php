<?php

namespace Core\Middleware;
use Core\Auth;

class Admin
{
    public function handle()
    {
        if (! isset($_SESSION['user']) || ! isset($_SESSION['rol'])) {
            Auth::recoverSession();
        }

        if ($_SESSION['rol'] !== 'admin') {
            abort(403);
        }
    }
}