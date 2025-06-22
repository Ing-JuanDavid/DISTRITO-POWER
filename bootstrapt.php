<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind('Core/Database', function(){
    $config = require base_path('config/config.php');
    return new Database($config['database']);
});

App::set_Container($container);

//var_dump(App::container()->resolve('Core/Database'));




