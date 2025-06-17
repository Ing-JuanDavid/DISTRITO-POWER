<?php

view('user/changePass.view.php', [
    'links' => require base_path('links.php'),
    'alert' => \Core\Response::getAlert(),
    'userId' => getFromSession('userId'),
]);


