<?php

use Core\Database;

$heading = 'Les userAccount';
$currentUserId = 1;
$database = new Database(ENV_FILE);
$users = $database->query('SELECT id, firstname, lastname, email FROM users')->all();
view('userAccount/index.view.php',compact('heading','users'));