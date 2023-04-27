<?php
function urlIs(string $path): bool
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $path;
}

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path,array $params)
{
    extract($params);
    require base_path('views/'.$path);
    $_SESSION['errors'] = [];
    $_SESSION['olds'] = [];
    $_SESSION['flash'] = [];
}

function generatePassword(int $length = 15){
    $password =chr(rand(48,57));
    $password .=chr(rand(65,90));
    $password .=chr(rand(97,122));
    $password .=chr(rand(33,45));
    for ($i = 0; $i< ($length - strlen($password));$i++ ){
        $random_char= chr(rand(97,122));
        $password.=$random_char;
    }
    return str_shuffle($password);
}
