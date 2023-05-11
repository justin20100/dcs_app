<?php

use Controllers\AboutController;
use Controllers\ContactController;
use Controllers\DashboardController;
use Controllers\NoteController;
use Controllers\UserAccountController;
use Controllers\UserSessionController;

$router->get('/',[DashboardController::class,'index']);
$router->get('/about',[AboutController::class,'index']);
$router->get('/contact',[ContactController::class,'index']);

//notes
$router->get('/notes',[NoteController::class,'index'])->only('authenticated');
$router->get('/note' , [NoteController::class,'show'])->only('authenticated');
$router->get('/notes/create',[NoteController::class,'create'])->only('authenticated');
$router->post('/notes',[NoteController::class,'store'])->only('authenticated')->csrf();
$router->delete('/note/delete',[NoteController::class,'destroy'])->only('authenticated');
$router->get('/note/update',[NoteController::class,'update'])->only('authenticated');
$router->put('/note/put',[NoteController::class,'put'])->only('authenticated');

//userAccount creation
$router->get('/register',[UserAccountController::class,'create'])->only('guest');
$router->post('/register',[UserAccountController::class,'store'])->only('authenticated');

//userAccount login
$router->get('/login',[UserSessionController::class,'create'])->only('guest');
$router->post('/login',[UserSessionController::class,'store'])->only('guest');
$router->delete('/logout',[UserSessionController::class,'destroy'])->only('authenticated');