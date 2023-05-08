<?php

namespace Controllers;

use Core\Database;
use Core\Response;
use Core\Validator;

class UserAccountController
{
    public function create()
    {
        $heading = 'Register a user';
        $_SESSION['suggested_password'] = generatePassword();
        view('userAccount/create.view.php', compact('heading'));
    }

    public function store()
    {
        $_SESSION['olds']['firstname'] = $_POST['firstname'];
        $_SESSION['olds']['lastname'] = $_POST['lastname'];
        $_SESSION['olds']['email'] = $_POST['email'];
        $_SESSION['olds']['password'] = $_POST['password'];
        if (!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            Response::abort(Response::BAD_REQUEST);
        }

        if (!Validator::email($_POST['email'])) {
            $_SESSION['errors']['email'] = "Attention votre email n'est pas valide";
        }

        if (Validator::exists($_POST['email'], 'users', 'email')) {
            $_SESSION['errors']['email'] = "Cette email est deja prise";
        }

        if (!Validator::between($_POST['firstname'], 3, 50,)) {
            $_SESSION['errors']['firstname'] = "Le firstname doit avoir entre 3 et 50 caracteres ";
        }

        if (!Validator::between($_POST['lastname'], 3, 50,)) {
            $_SESSION['errors']['lastname'] = "Le lastname doit avoir entre 3 et 50 caracteres ";
        }

        if (!Validator::password($_POST['password'])) {
            $_SESSION['errors']['password'] = 'Attention le mot de passe doit contenir au moins 8 caractères avec minimum une majuscule, une minuscule, un caractere special et un chiffre';
        }

        if (empty($_SESSION['errors'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $database = new Database(ENV_FILE);
            $database->query('INSERT INTO users(firstname, lastname, email, password) values( :firstname,:lastname, :email, :password)',
                [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password
                ]);
            $location = $_SERVER['HTTP_ORIGIN'] . '/login';
            $_SESSION['flash']['succes'] = 'Hello ' . $_POST['firstname'];
        } else {
            $_SESSION['suggested_password'] = generatePassword();
            $location = $_SERVER['HTTP_REFERER'];
        }
        Response::redirect("Location: " . $location);
        exit;
    }
}