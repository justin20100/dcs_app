<?php

use Core\Database;
use Core\Response;
use Core\Validator;

$currentUserId = $_POST['currentUserId'];

$errors = [];
if (!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']) || !isset($_POST['password'])) {
    Response::abort(Response::BAD_REQUEST);
}

if (!Validator::email($_POST['email'])) {
    $errors['email'] = "Attention votre email n'est pas valide";
}

if (Validator::exists($_POST['email'], 'users', 'email')) {
    $errors['email'] = "Cette email est deja prise";
}

if (!Validator::between($_POST['firstname'], 3, 50,)) {
    $errors['firstname'] = "Le firstname doit avoir entre 3 et 50 caracteres ";
}

if (!Validator::between($_POST['lastname'], 3, 50,)) {
    $errors['lastname'] = "Le lastname doit avoir entre 3 et 50 caracteres ";
}

if (!Validator::password($_POST['password'])) {
    $errors['password'] = 'Attention le mot de passe doit contenir au moins 8 caractères avec minimum une majuscule, une minuscule, un caractere special et un chiffre';
}

if (empty($errors)) {
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
    Response::redirect("{$_SERVER['HTTP_HOST']}/login");
} else {
    $heading = 'Register a user';
    $suggested_password = generatePassword();
    view('userAccount/create.view.php', compact('heading', 'errors', 'currentUserId', 'suggested_password'));
}