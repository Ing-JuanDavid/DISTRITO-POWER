<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        if (! isset($_SESSION['user']) && ! isset($_COOKIE['token'])) {
            abort(403);
        }
    }
}