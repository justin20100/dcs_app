<?php

use Core\Database;
use Core\Response;

$heading = 'Modifier le user';
$currentUserId = 1;
$id = (int)$_GET['id'];
$database = new Database(ENV_FILE);
$user = $database->query('SELECT * FROM users where id = :id', ['id' => $id])->findOrFail();
$user['password'] = password_verify($user['password'], );
view('userAccount/update.view.php',compact('heading','user'));
