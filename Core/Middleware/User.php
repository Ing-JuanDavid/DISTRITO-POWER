<?php

namespace Core\Middleware;

use Core\Services\AuthService;
use models\User as ModelsUser;

class User
{
    public function handle()
    {

        $user = $_SESSION['user'] ?? null;
        $userId = $_SESSION['userId'] ?? null;

        if($user) {
            if(! ModelsUser::findUserByEmail($user) || ! ModelsUser::findUserById($userId)) AuthService::logOut();
        }


        if(! $user) {
            if (! AuthService::chekKeepSession()) abort(403);
        }
        
    
        if (! isset($_SESSION['rol']) || $_SESSION['rol'] !== 'user') {
            abort(403);
        }
    }
}