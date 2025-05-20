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

view('logIn/logIn.view.php', [
    'alert' => Response::getAlert(),
    'links' => $links
]);