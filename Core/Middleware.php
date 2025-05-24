<?php

namespace Core;

use Core\Middleware\Admin;
use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\User;

class Middleware
{
    const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
        'admin' => Admin::class,
        'user' => User::class
    ];
}