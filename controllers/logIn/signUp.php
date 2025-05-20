<?php

use Core\Response;

$links = [
    [
        'name' => 'Inicio',
        'route' => '/'
    ],
    [
        'name' => 'LogIn',
        'route' => '/login'
    ],
    [
        'name' => 'signUp',
        'route' => '/signup'
    ]
];

view('logIn/signUp.view.php', [
    'alert' => Response::getAlert(),
    'links' => $links
]);