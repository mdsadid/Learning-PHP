<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function get($uri, $controller): void
    {
        $this->register($uri, $controller, 'GET');
    }

    public function post($uri, $controller): void
    {
        $this->register($uri, $controller, 'POST');
    }

    public function put($uri, $controller): void
    {
        $this->register($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller): void
    {
        $this->register($uri, $controller, 'PATCH');
    }

    public function delete($uri, $controller): void
    {
        $this->register($uri, $controller, 'DELETE');
    }

    protected function register($uri, $controller, $method): void
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => $method
        ];
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        abort();

        return null;
    }
}
