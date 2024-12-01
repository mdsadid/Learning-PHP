<?php

namespace Core;

use Core\Middleware\MiddlewareResolver;
use Exception;

class Router
{
    protected array $routes = [];

    public function get($uri, $controller): static
    {
        return $this->register($uri, $controller, 'GET');
    }

    public function post($uri, $controller): static
    {
        return $this->register($uri, $controller, 'POST');
    }

    public function put($uri, $controller): static
    {
        return $this->register($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller): static
    {
        return $this->register($uri, $controller, 'PATCH');
    }

    public function delete($uri, $controller): static
    {
        return $this->register($uri, $controller, 'DELETE');
    }

    protected function register($uri, $controller, $method): static
    {
        $this->routes[] = [
            'uri'        => $uri,
            'controller' => $controller,
            'method'     => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                try {
                    MiddlewareResolver::resolve($route['middleware']);
                } catch (Exception $exception) {
                    echo $exception->getMessage();
                    die();
                }

                return require base_path("Http/Controllers/{$route['controller']}");
            }
        }

        abort();

        return null;
    }

    public function only(string $key): void
    {
        $lastKey = array_key_last($this->routes);

        $this->routes[$lastKey]['middleware'] = $key;
    }

    public function group(array $attributes, callable $callback): void
    {
        $originalRoutes = $this->routes;

        $callback($this);

        $newRoutes = array_slice($this->routes, count($originalRoutes));

        foreach ($newRoutes as $newRoute) {
            if (isset($attributes['middleware'])) {
                $newRoute['middleware'] = $attributes['middleware'];
                $originalRoutes[]       = $newRoute;
            }
        }

        $this->routes = $originalRoutes;
    }
}
