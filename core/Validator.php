<?php

namespace Core;
use Intervention\Image\ImageManagerStatic as Image;

class Validator
{
    public static function correctRequest(array $array, string $key): bool
    {
        return array_key_exists($key, $array);
    }

    public static function between(string $string, int $min = 1, int $max = INF): bool
    {
        return !(strlen(trim($string)) > $max || strlen(trim($string < $min)));
    }

    public static function email($email): bool
    {
        return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function exists(mixed $value, string $table, string $field): bool
    {
        $database = new Database(ENV_FILE);
        return (bool)$database->query("SELECT `{$field}` FROM `{$table}` WHERE `{$field}`=:value", ['value' => $value])->find();
    }

    public static function password($password, $length = 8): bool
    {

        if (strlen(trim($password))<8) {
            return false;
        }

        // verifier les symboles autorisés
        if (!preg_match("/[0-9]/", $password) ||
            !preg_match("/[a-z]/", $password) ||
            !preg_match("/[A-Z]/", $password) ||
            preg_match("/[\S]/", $password) ||
            !preg_match("/[\-\!_$&\$^^%?]/", $password)
        ) {
            return true;
        } else {
            return false;
        }
    }

    public static function file(){
        if (!empty($_FILES['thumbnail']['tmp_name'])){
            // verifier le type de fichier envoyé
            if ($_FILES){
                return true;
            }else{
                $_SESSION['errors']['file'] = "Ce fichier n'est pas une image valide";
                return false;
            }
        }else{
            $_SESSION['errors']['file'] = "Vous avez oublié d'ajouter une image";
            return false;
        }
    }
}