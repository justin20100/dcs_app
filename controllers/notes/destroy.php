<?php

use Core\Database;
use Core\Response;
use Core\Validator;

$database = new Database(ENV_FILE);
$id = $_POST['id'];
$database->query('DELETE FROM notes WHERE id = :id', ['id' => $id]);
Response::redirect('Location: http://dcs_app.test/notes');