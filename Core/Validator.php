<?php 

namespace Core;
use \Core\Response;
use Core\Services\AuthService;

class Validator {
    
    public static function email($email, $url)
    {
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Response::redirect($url, 'danger', 'Email invalido');
        }
    }


    public static function inputs($inputs, $url) 
    {
        foreach($inputs as $input => $value) {

            if($input == 'remember') continue;

            if(! isset($value) || empty($value)) {
                Response::redirect($url, 'danger',  'Campos requeridos');
            }
        }

        return $inputs;
    }

    public static function rol($rol, $allowedRoles = [], $url)
    {
        if (! in_array($rol, $allowedRoles)) {
            Response::redirect($url, 'danger', 'Rol invalido');
        }
    }

    public static function userByToken($inputs)
    {

        $token = $_COOKIE['token'] ?? null;

        if(! $token) Response::redirect('/login', 'danger', 'No podemos validar tu sesion');

        $token = hash('md5', $token);

        $user = \models\User::findByToken($token);

        if(! $user) {
            Response::redirect('/login', 'danger', 'Token invalido');
        }

        if($user->__get('email') != $inputs['email'] || $user->__get('rol') != $inputs['rol']  || $user->__get('userId') != $inputs['userId']) {
            $params = session_get_cookie_params();
            setcookie('PHPSESSID', '', time()-3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            setcookie("token", "", time() - 3600, "/", false, true); // Se elimina el token
            abort(403);
        }

    }

    public static function user($userId, $url)
    {
        $id = $_SESSION['userId'] ?? null;

        if(! $id) Response::redirect('/login', 'info', 'Primero debes iniciar sesion');

        if($id != $userId )  Response::redirect($url, 'danger', 'Accion no autorizada');
        
    }
}








