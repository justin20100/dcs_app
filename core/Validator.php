<?php

namespace Core;
class Validator
{
    public static function correctRequest(array $array, string $key): bool
    {
        return array_key_exists($key, $array);
    }

    public static function between(string $string, int $min = 1, int $max = INF): bool
    {
        return !(strlen(trim($string)) > $max || strlen(trim($string < $min)));
    }
}