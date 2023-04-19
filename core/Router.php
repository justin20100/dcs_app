<?php

namespace Core;

class Router
{
    protected array $routes = [];

    protected function add($method, $uri, $controller)
    {
        $this->routes[] = compact('method', 'uri', 'controller');
    }

    public function get(string $uri, string $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    public function put(string $uri, string $controller)
    {
        $this->add('PUT', $uri, $controller);
    }

    public function patch(string $uri, string $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function delete(string $uri, string $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function route($uri,$method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path('controllers/' . $route['controller']);
            }
        }
        Response::abort();
    }
}