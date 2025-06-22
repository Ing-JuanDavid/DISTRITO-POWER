<?php

namespace Core\Middleware;

class Token
{
    public function handle()
    {
        if (! isset($_COOKIE['token']) || getFromSession('user') || getFromSession('rol')) {
            abort(403);
        }

    }
}