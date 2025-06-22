<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        if (! getFromSession('user') && ! isset($_COOKIE['token'])) {
            abort(403);
        }
    }
}