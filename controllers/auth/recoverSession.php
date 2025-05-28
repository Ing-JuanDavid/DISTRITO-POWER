<?php

use Core\Response;


$inputs = getPost('email', 'rol');

if (! isset($inputs['email']) || ! isset($inputs['rol'])) abort(400);

start_session($inputs['email'], $inputs['rol']);

Response::redirectToDashboard();