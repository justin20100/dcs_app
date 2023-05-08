<?php

use Core\Database;

$heading = 'Mes Notes';
$database = new Database(ENV_FILE);
$notes = $database->query('SELECT * FROM Notes where user_id = :user_id', ['user_id' => $_SESSION['user']->id])->all();
view('notes/index.view.php',compact('heading','notes'));
