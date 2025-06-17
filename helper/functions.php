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

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($view, $attributes = [])
{
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

function getFromSession($key) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION[$key] ?? null;
}


function getPost(...$inputs)
{
    return array_combine($inputs, array_map(fn($i) => $_POST[$i] ?? null, $inputs));
}

function getRole()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['rol'] ?? null;
}

function stringToDate($string)
{
    return $date = date('d-M-Y', strtotime($string));
}

// cotar por el mes actual
function countCurrentMonth($arr, $prop)
{
    $cont = 0;
    foreach ($arr as $item) {
        if (strpos($item[$prop], date('M'))) $cont++;
    }
    return $cont;
}


// contar cualquier consa dentro de un array
function countAnything($arr, $prop, $value)
{
    $cont = 0;
    foreach ($arr as $item) {
        if ($item[$prop] == $value) $cont++;
    }
    return $cont;
}


function monthsTransurred()
{
    $currentMonth =  date('F');

    $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    $result = [];
    foreach ($months as $month) {
        if ($month == $currentMonth) {
            $result[] = $month;
            return $result;
        }
        $result[] = $month;
    }
}

function isUri($uri)
{
    return ($uri == parse_url($_SERVER['REQUEST_URI'])['path']);
}

