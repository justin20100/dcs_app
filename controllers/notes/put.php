<?php

use Core\Database;
use Core\Response;
use Core\Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUserId = $_POST['currentUserId'];

    $errors=[];
    if (!Validator::correctRequest($_POST,'description')){
        Response::abort(Response::BAD_REQUEST);
    }

    if (!Validator::between($_POST['description'],1,1000)){
        $errors['description'] = 'Attention la description doit faire entre 1 et 1000 caractères.';
    }

    if (empty($errors)){
        $description = $_POST['description'];
        $id = $_POST['id'];
        $database = new Database(ENV_FILE);
        $database->query('UPDATE notes SET description = :description WHERE id = :id', ['description' => $description, 'id' => $id]);
        Response::redirect('Location: http://dcs_app.test/notes');
    }else{
        $heading = 'Update note';
        view('notes/update.view.php',compact('heading','errors', 'currentUserId'));
    }

} else {
    Response::abort(Response::NOT_ALLOWED);
}