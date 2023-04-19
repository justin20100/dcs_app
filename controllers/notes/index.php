<?php

use Core\Database;

$heading = 'Mes Notes';
$currentUserId = 1;
$database = new Database(ENV_FILE);
$notes = $database->query('SELECT * FROM Notes where user_id = :user_id', ['user_id' => $currentUserId])->all();
view('notes/index.view.php',compact('heading','notes'));
