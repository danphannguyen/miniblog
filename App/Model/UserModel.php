<?php

namespace Dan\Miniblog\Model;

use \PDO;

class UserModel
{

    public static function dbConnect()
    {
        return new PDO('mysql:host=localhost;dbname=miniblog;port=8889,charest=utf8', 'root', 'root');
    }

    public static function isMailExist($mail)
    {
        $db = UserModel::dbConnect();

        $query = "SELECT mail_user FROM users where mail_user = :mail";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);

        return !empty($result);
    }


    public static function passwordCheck($mail, $password)
    {
        $db = UserModel::dbConnect();

        $query = "SELECT password_user FROM users where mail_user = :mail";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);

        return password_verify($password, $result[0]['password_user']);
    }

    public static function addUser($mail, $password, $firstname, $lastname)
    {

        $db = UserModel::dbConnect();

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (mail_user, password_user, firstname_user, lastname_user) VALUES (:mail, :pswd, :firstname, :lastname)";

        $stmt = $db->prepare($query);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":pswd", $hash, PDO::PARAM_STR);
        $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
        // Exécution de la requête et retourne son état
        return $stmt->execute();

    }
}

?>

<!-- Permet d'avoir des fontions multiples -->