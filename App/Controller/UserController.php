<?php

namespace Dan\Miniblog\Controller;

use Dan\Miniblog\Model\UserModel;

class UserController {
    
        public function connexion($mail, $password) {
            if (UserModel::isMailExist($mail)) {
                if (UserModel::passwordCheck($mail, $password)) {
                    // ICI ON PEUT CREER LA SESSION
                    return '<span style="color: green">Connexion réussie</span>';
                } else {
                    return '<span style="color: red">Mot de passe incorrect</span>';
                }
            } else {
                return '<span style="color: red">L adresse mail n existe pas</span>';
            }
        }
    
        public function register($mail, $password, $firstname, $lastname){
            if (UserModel::isMailExist($mail)) {
                return '<span style="color: red">L adresse mail existe déjà</span>';
            } else {
                if(UserModel::addUser($mail, $password, $firstname, $lastname)) {
                    return '<span style="color: green">Inscription réussie</span>';
                } else {
                    return '<span style="color: red">Erreur lors de l inscription</span>';
                }
            }
        }
    
}


?>

<!-- Controler AVEC FULL IF / SWITCH CASE -->