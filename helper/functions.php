<?php

use Core\Response;

use function PHPSTORM_META\map;

    function dd($value) 
    {
        echo "<pre>";
        var_dump($value);
        echo "<pre>";
        die();
    }

    function abort($code = 404) 
    {
        http_response_code($code);
        
        $links = require base_path("links.php");

        view("errores/$code.php", [
            'links' => $links
        ]);
        die();
    }

    function start_session($user, $rol = "user") 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["user"] = $user;
        $_SESSION["rol"] = $rol;
    }


    function getPost(...$inputs)
    {
        return array_combine($inputs, array_map(fn($i) => $_POST[$i] ?? null, $inputs));
    }

function stringToDate($arr, $dateProp)
{
    foreach ($arr as $key => $value) {
        $timestamp = strtotime($value[$dateProp]);
        $arr[$key][$dateProp] = date("d-M-Y", $timestamp);
    }
    return $arr;
}


    // function recoverSession() 
    // {
    //     session_start();
    //     $user = $_SESSION["user"] ?? null;
    //     $token = $_COOKIE["token"] ?? null;

    //     if(!$user){
    //         if($token) {
    //             $token = hash("md5", $token);
    //             $user = User::findByToken($conn, $token);
    //             if($user) {
    //                 $_SESSION["user"] = $user->__get("email");
    //                 $_SESSION["rol"] = $user->__get("rol");
    //             }
    //         } else {
    //             echo 
    //             "<h2>Usted no tiene acceso</h2>
    //             <p>Por favor inicie <a href='../views/logIn.php'>sesion</a></p>";
    //             exit;
    //         }
    //     }
    // }

    
    function base_path($path) {
        return BASE_PATH . $path;
    }

    function view($view, $attributes = []) {
        extract($attributes);
        require base_path("views/$view");
    }

