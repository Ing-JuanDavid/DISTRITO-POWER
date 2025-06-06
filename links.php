<?php 
if(session_status() == PHP_SESSION_NONE) session_start();

$rol = $_SESSION['rol'] ?? null;

$links;

if(! in_array($rol, ['user' , 'admin'])) {
    $links = [
        ['name' => 'Inicio', 'route' => '/'],
        ['name' => 'Planes', 'route' => '/memberships'],
        ['name' => 'LogIn', 'route' => '/login'],
        ['name' => 'SignUp', 'route' => '/signup'],
    ];
}

if($rol == 'admin') {
    $links = [
        ['name' => 'Inicio', 'route' => '/'],
        ['name' => 'Dashboard', 'route' => '/admin/dashboard'],
        ['name' => 'Salir', 'route' => '/logout']
    ];
}

if($rol == 'user') {
    $links = [
        ['name' => 'Inicio', 'route' => '/'],
        ['name' => 'Dashboard', 'route' => '/user/dashboard'],
        ['name' => 'Salir', 'route' => '/logout']
    ];
}

return  $links;