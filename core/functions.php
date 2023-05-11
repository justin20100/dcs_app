<?php

use Intervention\Image\ImageManagerStatic as Image;

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

function csrf_token():void{
    $_SESSION['token'] = bin2hex(random_bytes(32));
    echo '<input type="hidden" name="token" value="'. $_SESSION['token'] .'" >';
}

function saveImages(){
    Image::configure(['driver' => 'gd']);
    $upload_img_dir = '/Users/justinvincent/Documents/Ecole/HEPL/3E/2022_2023_cours/devcoteserveur/dcs_app/storage/public/img';
    $parts = explode('.',$_FILES['thumbnail']['name']);
    $ext = $parts[array_key_last($parts)];
    $tmp_file = $_FILES['thumbnail']['tmp_name'];
    $image = Image::make($tmp_file);
    $height = (300*$image->height()) / $image->width();
    // 300
    $image->resize(300, $height);
    $file_name_300 = sha1_file($tmp_file).'300.'.$ext;
    $destination_file = $upload_img_dir . '/' . $file_name_300;
    $image->save($destination_file);
    // 600
    $image->resize(600, $height*2);
    $file_name_600 = sha1_file($tmp_file).'600.'.$ext;
    $destination_file = $upload_img_dir . '/' . $file_name_600;
    $image->save($destination_file);
    // 150
    $image->resize(150, $height/2);
    $file_name_150 = sha1_file($tmp_file).'150.'.$ext;
    $destination_file = $upload_img_dir . '/' . $file_name_150;
    $image->save($destination_file);

}
