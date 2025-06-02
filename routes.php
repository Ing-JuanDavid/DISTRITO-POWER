<?php


//views
//LogIn
$router->get('/', base_path('controllers/home.php'))->only('anyone');
$router->get('/login', base_path('controllers/logIn/logIn.php'))->only('guest');
$router->get('/signup', base_path('controllers/logIn/signUp.php'))->only('guest');
$router->get('/recover', base_path('controllers/logIn/recover.php'))->only('guest');
$router->get('/logout',  base_path('controllers/auth/logOut.php'))->only('auth');
$router->get('/keepSession', base_path('controllers/logIn/keepSession.php'))->only('token');

// Users
$router->get('/admin/dashboard', base_path('controllers/admin/index.php'))->only('admin');
$router->get('/dashboard', base_path('controllers/user/index.php'))->only('user');
$router->get('/memberships', base_path('controllers/membership/index.php'))->only('anyone');

// Auth actions
$router->post('/login', base_path('controllers/auth/logIn.php'))->only('guest');
$router->post('/recover', base_path('controllers/auth/recover.php'))->only('guest');
$router->post('/signup', base_path('controllers/auth/signUp.php'))->only('guest');
$router->post('/recoversession', base_path('controllers/auth/recoverSession.php'))->only('token');

// Admin actions
//  User
$router->post('/admin/dashboard/adduser', base_path('controllers/admin/createUser.php'))->only('admin');
$router->post('/admin/dashboard/edituser', base_path('controllers/admin/editUser.php'))->only('admin');
$router->get('/admin/dashboard/destuser/', base_path('controllers/admin/destroyUser.php'))->only('admin');
//  Membership Types
$router->post('/admin/dashboard/addmem', base_path('controllers/admin/createMemT.php'))->only('admin');
$router->post('/admin/dashboard/editmem', base_path('controllers/admin/editMem.php'))->only('admin');
$router->get('/admin/dashboard/destmem/', base_path('controllers/admin/destroyMem.php'))->only('admin');
//  Memberships
$router->get('/admin/pays/asistencia', base_path('controllers/admin/asistencia.php'))->only('admin');
// Payments
$router->post('/admin/dashboard/report', base_path('controllers/admin/makeReport.php'))->only('admin');

//User actions
// Buy Membership
$router->post('/membership/create', base_path('controllers/membership/create.php'))->only('auth');
