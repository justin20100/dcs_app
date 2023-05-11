<?php

namespace Core\Middleware;
use Exception;

class Middleware
{
    protected const MAP = [
        'guest'=>Guest::class,
        'authenticated'=>Authenticated::class,
        'csrf'=>Csrf::class,
    ];

    public static function resolve(string|null $middlewares=null): void
    {
        foreach ($middlewares as $name){
            if(!array_key_exists($name,self::MAP)){
                throw new Exception("this middleware doesn't exist");
            }
            $middleware = self::MAP[$name];
            (new $middleware)->handle();
        }

    }
}