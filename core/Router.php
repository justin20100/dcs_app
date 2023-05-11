<?php

namespace Core;

use Core\Middleware\Middleware;
use Exception;

class Router
{
    protected array $routes = [];

    protected function add($method, $uri, $controller)
    {
        $middleware = [];
        $this->routes[] = compact('method', 'uri', 'controller','middleware');
        return $this;
    }

    public function get(string $uri, array|string $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, array|string $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function put(string $uri, array|string $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function patch(string $uri, string $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function delete(string $uri, array|string $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function only(string $key):Router{
        $this->routes[array_key_last($this->routes)]['middleware'][] = $key;
        return $this;
    }

    public function csrf(string $key):Router{
        $this->routes[array_key_last($this->routes)]['middleware'][] = 'csrf';
        return $this;
    }

    public function route($uri,$method):Router
    {
        $routes = array_values(array_filter($this->routes, fn ($r) => $uri === $r['uri'] && strtoupper($method) === $r['method']));
        if (empty($routes)) {
            Response::abort();
        }
        if (!is_null($routes[0]['middleware'])){
            try {
                Middleware::resolve($routes[0]['middleware']);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        $controller = new $routes[0]['controller'][0];
        $controllerMethod = $routes[0]['controller'][1];
        call_user_func([$controller, $controllerMethod]);
//        require base_path('controllers/'. $routes[0]['controller']);
    }
}