<?php

use Core\Database;
use Core\Response;

$heading = 'Note';
$id = (int)$_GET['id'];
$database = new Database(ENV_FILE);
$note = $database->query('SELECT * FROM Notes where id = :id', ['id' => $id])->findOrFail();
if ($_SESSION['user']->id !== $note->user_id) {
    Response::abort(Response::FORBIDDEN);
}
view('notes/show.view.php',compact('heading','note'));
