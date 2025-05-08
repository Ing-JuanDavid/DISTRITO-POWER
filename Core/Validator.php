<?php 

namespace Core;
use \Core\Response;

class Validator {
    
    public static function email($email, $url)
    {
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Response::redirect($url, 'error', 'Email invalido');
        }
    }


    public static function inputs($inputs, $url) 
    {
        foreach($inputs as $input => $value) {

            if($input == 'remember') continue;

            if(! isset($value) || empty($value)) {
                Response::redirect($url, 'error',  'Campos requeridos');
            }
        }

        return $inputs;
    }

    public static function rol($rol, $allowedRoles = [], $url)
    {
        if (! in_array($rol, $allowedRoles)) {
            Response::redirect($url, 'error', 'Rol invalido');
        }
    }
}








