<?php

namespace Core\Middleware;

class Token
{
    public function handle()
    {
        if (! isset($_COOKIE['token']) || isset($_SESSION['user']) || isset($_SESSION['rol'])) {
            abort(403);
        }

    }
}