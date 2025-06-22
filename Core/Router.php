<?php

namespace Core;

class Router {

    protected $routes;

    public function add($uri, $method, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller,
            'middleware' => null
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, 'GET', $controller);
        return $this;
    }

    public function post($uri, $controller)
    {
        $this->add($uri, 'POST', $controller);
        return $this;
    }

    public function only($middleware)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {

            if ($route['uri'] === $uri && $route['method'] === $method) {

                $class = Middleware::MAP[$route['middleware']] ?? null;
                
                if($class) {
                    (new $class())->handle();
                }
                
                return require $route['controller'];
            }
        }

        abort(404);
    }
}
