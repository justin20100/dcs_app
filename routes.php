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

//userAccount creation
$router->get('/register','userAccount/create.php');
$router->post('/register','userAccount/store.php');

//userAccount login
$router->get('/login','userSession/create.php');
$router->post('/login','userSession/store.php');

// userAcount logout
$router->delete('/logout','userSession/destroy.php');