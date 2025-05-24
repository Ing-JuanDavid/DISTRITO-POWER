<?php

namespace Core\Middleware;

class User
{
    public function handle()
    {
        if (! isset($_SESSION['rol']) || $_SESSION['rol'] !== 'user') {
            abort(403);
        }
    }
}