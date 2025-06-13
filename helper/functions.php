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

    function base_path($path) {
        return BASE_PATH . $path;
    }

    function view($view, $attributes = []) {
        extract($attributes);
        require base_path("views/$view");
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

    function start_session($user, $rol = "user", $userId) 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["user"] = $user;
        $_SESSION["rol"] = $rol;
        $_SESSION["userId"] = $userId;
    }


    function getPost(...$inputs)
    {
        return array_combine($inputs, array_map(fn($i) => $_POST[$i] ?? null, $inputs));
    }

    function getRole()
    {
        if(session_status()===PHP_SESSION_NONE)
        {
            session_start();
        }
        return $_SESSION['rol'] ?? null;
    }

    function stringToDate($string)
    {
        return $date = date('d-M-Y', strtotime($string));
    }


    function countCurrentMonth($arr, $prop)
    {
        $cont = 0;
        foreach($arr as $item) {
            if(strpos($item[$prop], date('M'))) $cont++;
        }
        return $cont;
    }

    function countAnything($arr, $prop, $value)
    {
        $cont = 0;
        foreach($arr as $item) {
            if($item[$prop] == $value) $cont++;
        }
        return $cont;
    }
    

