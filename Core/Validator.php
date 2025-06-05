<?php 

namespace Core;
use \Core\Response;

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

    public static function user($userId, $url)
    {
        $id = $_SESSION['userId'] ?? null;

        if(! $id) Response::redirect('/login', 'info', 'Primero debes iniciar sesion');

        if($id != $userId )  Response::redirect($url, 'danger', 'Accion no autorizada');
        
    }
}








