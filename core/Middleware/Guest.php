<?php

namespace Core\Middleware;

use Core\Response;

class Guest
{
    public function handle(){
        if (!empty($_SESSION['user'])){
            Response::redirect('Location: /');
        }
    }
}