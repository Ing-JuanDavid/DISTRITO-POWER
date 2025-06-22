<?php

namespace Core;

use Core\Middleware\Admin;
use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Token;
use Core\Middleware\User;
use Core\Middleware\Anyone;

class Middleware
{
    const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
        'admin' => Admin::class,
        'user' => User::class,
        'token' => Token::class,
        'anyone' => Anyone::class,
    ];
}