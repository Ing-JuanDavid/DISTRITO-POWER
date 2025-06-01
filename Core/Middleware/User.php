<?php

namespace Core\Middleware;

use Core\Services\AuthService;
use models\User as ModelsUser;

class User
{
    public function handle()
    {

        $user = $_SESSION['user'] ?? null;

        if($user) {
            if(! ModelsUser::findUserByEmail($user)) AuthService::logOut();
        }


        if(! $user) {
            if (! AuthService::recoverSession()) abort(403);
        }
        
    
        if (! isset($_SESSION['rol']) || $_SESSION['rol'] !== 'user') {
            abort(403);
        }
    }
}