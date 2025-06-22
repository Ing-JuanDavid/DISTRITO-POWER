<?php

namespace Core\Middleware;

use Core\Services\AuthService;
use models\User as ModelsUser;

class User
{
    public function handle()
    {

        $user = getFromSession('user');
        $userId = getFromSession('userId');

        if(! $user && ! AuthService::chekKeepSession())  abort(403);

        if($user) {
            if(! ModelsUser::findUserByEmail($user) || ! ModelsUser::findUserById($userId)) AuthService::logOut();
        }
    
        if (! getFromSession('rol') || getFromSession('rol') !== 'user') abort(403);

    }
}