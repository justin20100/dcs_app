<?php

namespace Core\Middleware;

use Core\Response;

class Csrf
{
    public function handle(){
        if (!isset($_REQUEST['token']) || $_SESSION['token'] !== $_REQUEST['token']){
            Response::abort(Response::BAD_REQUEST);
        }
    }
}