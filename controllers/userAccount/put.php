<?php

use Core\Database;
use Core\Response;
use Core\Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUserId = $_POST['currentUserId'];

    $errors=[];
    if (!Validator::correctRequest($_POST,'firstname') && !Validator::correctRequest($_POST,'lastname') && !Validator::correctRequest($_POST,'email') && !Validator::correctRequest($_POST,'password') && !Validator::correctRequest($_POST,'validated_password'))
    {
        Response::abort(Response::BAD_REQUEST);
    }

    if (!Validator::validateEmail($_POST['email'])){
        $errors['description'] = "Attention votre email n'est pas valide";
    }

    if (!Validator::validatePassword($_POST['password'],$_POST['validated_password']))
    {
        $errors['description'] = 'Attention le mot de passe doit contenir au moins 8 caractères avec minimum une majuscule et un chiffre';
    }

    if (empty($errors)){
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $database = new Database(ENV_FILE);
        $database->query('UPDATE users set firstname=:firstname, lastname=:lastname, email=:email, password=:password WHERE users.id = :id', [ 'id'=>$id, 'firstname'=> $firstname, 'lastname'=>$lastname,'email'=>$email,'password'=>$password]);
        Response::redirect('Location: http://dcs_app.test/users');
    }else{
        $heading = 'Update user';
        view('userAccount/update.view.php',compact('heading','errors', 'currentUserId'));
    }

} else {
    Response::abort(Response::NOT_ALLOWED);
}