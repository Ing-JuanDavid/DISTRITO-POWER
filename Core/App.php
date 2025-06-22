<?php

namespace Core;

class App {
    static protected $container;

    public static function set_container($container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function dataBase()
    {
        return self::$container->resolve('Core/Database');
    }
}