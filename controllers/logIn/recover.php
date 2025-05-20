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

view('logIn/recover.view.php', [
    'alert' => Response::getAlert(),
    'links' => $links
]);