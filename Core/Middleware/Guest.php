<?php

namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        if (getFromSession('user')) {
            abort(403);
        }
    }
}