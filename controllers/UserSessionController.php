<?php

namespace Controllers;

use Core\Database;
use Core\Response;

class UserSessionController
{
    public function create(){
        $heading = 'Login a user';
        view('userSession/create.view.php',compact('heading'));
    }

    public function store(){
        $_SESSION['olds']['email'] = $_POST['email'];
        $_SESSION['olds']['password'] = $_POST['password'];

        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            Response::abort(Response::BAD_REQUEST);
        }

        $database = new Database(ENV_FILE);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $database->query('SELECT * FROM users where email = :email', ['email' => $email])->find();

        if (!$user){
            $_SESSION['errors']['email'] = "Cette email n'est pas enregistrée dans notre base de données";
        }else{
            if(!password_verify($_POST['password'],$user->password)){
                $_SESSION['errors']['password'] = 'password incorrecte';
            }
        }

        if (empty($_SESSION['errors'])) {
            $_SESSION['user'] = $user;
            $location = $_SERVER['HTTP_ORIGIN'];
            $_SESSION['flash']['succes'] ='Welcome back '.$user->firstname;
        } else {
            $location = $_SERVER['HTTP_REFERER'];
        }
        Response::redirect('Location: '.$location);
        exit;
    }

    public function destroy(){
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        Response::redirect("Location:".$_SERVER['HTTP_ORIGIN']);
        exit();
    }
}