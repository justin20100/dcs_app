<?php

namespace Controllers;

use Core\Database;
use Core\Response;
use Core\Validator;

class NoteController
{
    public function index(){
        $heading = 'Mes Notes';
        $database = new Database(ENV_FILE);
        $notes = $database->query('SELECT * FROM Notes where user_id = :user_id', ['user_id' => $_SESSION['user']->id])->all();
        view('notes/index.view.php',compact('heading','notes'));
    }

    public function show(){
        $heading = 'Note';
        $id = (int)$_GET['id'];
        $database = new Database(ENV_FILE);
        $note = $database->query('SELECT * FROM Notes where id = :id', ['id' => $id])->findOrFail();
        if ($_SESSION['user']->id !== $note->user_id) {
            Response::abort(Response::FORBIDDEN);
        }
        view('notes/show.view.php',compact('heading','note'));
    }

    public function create(){
        $heading = 'Create Note';
        $currentUserId = 1;
        view('notes/create.view.php',compact('heading','currentUserId'));
    }

    public function store(){
        Validator::file();
        if (empty($_SESSION['errors'])) {
            $description = $_POST['description'];
            $database = new Database(ENV_FILE);
            $database->query('INSERT INTO notes(description, user_id) values(:description, :currentUserId)', ['description' => $description, 'currentUserId' => $_SESSION['user']->id]);
            $_SESSION['flash']['succes'] ='Une nouvelle note a été créee';
            $location = $_SERVER['HTTP_ORIGIN'];
        } else {
            $location = $_SERVER['HTTP_REFERER'];
        }
        Response::redirect('Location: '.$location);
        exit;

//        if (Validator::valideImage($image)){
//            $images = generate_images($image);
//            save_images($images);
//        }
        //valider et detecter les erreurs
        // generaliser la production d'images 300, 500, 900
//
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//
//            $errors=[];
//            if (!Validator::correctRequest($_POST,'description')){
//                Response::abort(Response::BAD_REQUEST);
//            }
//
//            if (!Validator::between($_POST['description'],1,1000)){
//                $errors['description'] = 'Attention la description doit faire entre 1 et 1000 caractères.';
//            }
//
//            if (empty($errors)){
//                $description = $_POST['description'];
//                $database = new Database(ENV_FILE);
//                $database->query('INSERT INTO notes(description, user_id) values(:description, :currentUserId)', ['description' => $description, 'currentUserId' => $_SESSION['user']->id]);
//                Response::redirect('Location: http://dcs_app.test/notes');
//            }else{
//                $heading = 'create note';
//                view('notes/create.view.php',compact('heading','errors'));
//            }
//
//        } else {
//            Response::abort(Response::NOT_ALLOWED);
//        }
    }

    public function destroy(){
        $database = new Database(ENV_FILE);
        $id = $_POST['id'];
        $database->query('DELETE FROM notes WHERE id = :id', ['id' => $id]);
        Response::redirect('Location: http://dcs_app.test/notes');
    }

    public function update(){
        $heading = 'Modifier';
        $currentUserId = 1;
        $id = (int)$_GET['id'];
        $database = new Database(ENV_FILE);
        $note = $database->query('SELECT * FROM Notes where id = :id', ['id' => $id])->findOrFail();
        if ($currentUserId !== $note->user_id) {
            Response::abort(Response::FORBIDDEN);
        }
        view('notes/update.view.php',compact('heading','note'));
    }

    public function put(){

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
    }
}