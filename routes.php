<?php

$router->get('/', base_path('controllers/home.php'))->only('anyone');
$router->get('/login', base_path('controllers/logIn/logIn.php'))->only('guest');
$router->get('/signup', base_path('controllers/logIn/signUp.php'))->only('guest');
$router->get('/recover', base_path('controllers/logIn/recover.php'))->only('guest');
$router->get('/logout',  base_path('controllers/auth/logOut.php'))->only('auth');

$router->get('/admin/pays/asistencia', base_path('controllers/admin/asistencia.php'))->only('admin');

$router->get('/admin/dashboard', base_path('controllers/admin/index.php'))->only('admin');
$router->get('/dashboard', base_path('controllers/user/index.php'))->only('user');
$router->get('/admin/dashboard/destuser/', base_path('controllers/admin/destroyUser.php'))->only('admin');
$router->get('/admin/dashboard/destmem/', base_path('controllers/admin/destroyMem.php'))->only('admin');

$router->post('/login', base_path('controllers/auth/logIn.php'))->only('guest');
$router->post('/recover', base_path('controllers/auth/recover.php'))->only('guest');
$router->post('/signup', base_path('controllers/auth/signUp.php'))->only('guest');
$router->post('/recoversession', base_path('controllers/auth/recoverSession.php'))->only('token');// This route is used to recover the session after a user logs in

$router->post('/admin/dashboard/adduser', base_path('controllers/admin/createUser.php'))->only('admin');
$router->post('/admin/dashboard/edituser', base_path('controllers/admin/editUser.php'))->only('admin');
$router->post('/admin/dashboard/addmem', base_path('controllers/admin/createMemT.php'))->only('admin');
$router->post('/admin/dashboard/editmem', base_path('controllers/admin/editMem.php'))->only('admin');
$router->post('/admin/dashboard/addpay', base_path('controllers/admin/createPay.php'))->only('admin');
$router->post('/admin/dashboard/report', base_path('controllers/admin/makeReport.php'))->only('admin');

