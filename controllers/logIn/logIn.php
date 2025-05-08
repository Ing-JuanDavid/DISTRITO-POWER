<?php

use Core\Response;

view('logIn/logIn.view.php', [
    'alert' => Response::getAlert()
]);