<?php 
if(session_status() == PHP_SESSION_NONE) session_start();

$rol = $_SESSION['rol'] ?? null;

$links;

if(! in_array($rol, ['user' , 'admin'])) {
    $links = [
        ['name' => 'Inicio', 'route' => '/'],
        ['name' => 'LogIn', 'route' => '/login'],
        ['name' => 'signUp', 'route' => '/signup']
    ];
}

if($rol == 'admin') {
    $links = [
        ['name' => 'Inicio', 'route' => '/'],
        ['name' => 'Dashboard', 'route' => '/admin/dashboard'],
        ['name' => 'Pagos', 'route' => '/admin/pays'],
        ['name' => 'Salir', 'route' => '/logout']
    ];
}

if($rol == 'user') {
    $links = [
        ['name' => 'Inicio', 'route' => '/'],
        ['name' => 'Dashboard', 'route' => '/dashboard'],
        ['name' => 'Salir', 'route' => '/logout']
    ];
}

return  $links;