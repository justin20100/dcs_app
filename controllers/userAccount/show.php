<?php

use Core\Database;

$heading = 'User';
$currentUserId = 1;
$id = (int)$_GET['id'];
$database = new Database(ENV_FILE);
$user = $database->query('SELECT id, firstname, lastname, email FROM users where id = :id', ['id' => $id])->findOrFail();
view('userAccount/show.view.php',compact('heading','user'));
