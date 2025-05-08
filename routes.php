<?php

$router->get('/', base_path('controllers/home.php'));
$router->get('/login', base_path('controllers/logIn/logIn.php'));
$router->get('/signup', base_path('controllers/logIn/signUp.php'));
$router->get('/recover', base_path('controllers/logIn/recover.php'));
$router->get('/logout',  base_path('controllers/auth/logOut.php'));

$router->get('/admin/dashboard', base_path('controllers/admin/index.php'));
$router->get('/admin/pays', base_path('controllers/admin/pays.php'));
$router->get('/dashboard', base_path('controllers/user/index.php'));

$router->post('/login', base_path('controllers/auth/logIn.php'));
$router->post('/recover', base_path('controllers/auth/recover.php'));
$router->post('/signup', base_path('controllers/auth/signUp.php'));

$router->post('/admin/dashboard/adduser', base_path('controllers/admin/createUser.php'));
$router->post('/admin/dashboard/addmem', base_path('controllers/admin/createMemT.php'));

