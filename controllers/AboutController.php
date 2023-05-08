<?php

namespace Controllers;

class AboutController
{
    public function index(){
        $heading = "About";
        view('pages/about.view.php',compact('heading'));
    }
}