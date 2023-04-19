<?php
namespace Core;
class Response
{

    const BAD_REQUEST = 400;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const NOT_ALLOWED = 405;

    public static function abort ($code = self::NOT_FOUND){
        http_response_code($code);
        require base_path("views/codes/{$code}.view.php");
        die();
    }

    public static function redirect ($uri){
        header($uri);
        die();
    }
}