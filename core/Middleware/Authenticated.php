<?php

namespace Core\Middleware;

use Core\Response;

class Authenticated
{
    public function handle(){
        if (empty($_SESSION['user'])){
            Response::redirect('Location: /');
        }
    }
}