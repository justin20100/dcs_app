<?php

$router->get('/','pages/dashboard.php');
$router->get('/about','pages/about.php');
$router->get('/contact','pages/contact.php');

//notes
$router->get('/notes','notes/index.php');
$router->get('/note' , 'notes/show.php');
$router->get('/notes/create','notes/create.php');
$router->post('/notes','notes/store.php');
$router->delete('/note/delete','notes/destroy.php');
$router->get('/note/update','notes/update.php');
$router->put('/note/put','notes/put.php');

//userAccount
$router->get('/users','userAccount/index.php');
$router->get('/user','userAccount/show.php');
$router->get('/register','userAccount/create.php');
$router->post('/register','userAccount/store.php');
$router->delete('/user/delete','userAccount/destroy.php');
$router->get('/user/update','userAccount/update.php');
$router->put('/user/put','userAccount/put.php');
