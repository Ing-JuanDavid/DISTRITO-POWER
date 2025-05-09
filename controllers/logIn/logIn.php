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
        'name' => 'sigUp',
        'route' => '/signup'
    ]
];

view('logIn/logIn.view.php', [
    'alert' => Response::getAlert(),
    'links' => $links
]);