<?php

namespace Controllers;

class ContactController
{
    public function index(){
        $heading = "Contact";
        view("pages/contact.view.php",compact('heading'));
    }
}