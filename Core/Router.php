<?php

namespace Core;

class Router {

    protected $routes;


    public function add($uri, $method, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, 'GET', $controller);
    }

    public function post($uri, $controller)
    {
        $this->add($uri, 'POST', $controller);
    }

    public function route($uri, $method)
    {
        foreach($this->routes as $route) {

            if($route['uri'] === $uri && $route['method'] === $method) {
                return require $route['controller'];
            }

        }
        abort(404);
    }

}