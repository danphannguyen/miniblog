<!DOCTYPE html>
<html lang="en">

<?php
session_start();

// Include du fichiers contenant toute les fonctions
include('./App/Model/UserModel.php');

// switch case pour traiter l'action
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'login':
            // Si c'est login on teste la connexion
            $result = connexion($_POST['mailLogin'], $_POST['passwordLogin']);
            include('./App/view/debugView.php');
            break;
        case 'register':
            // Si c'est un register on vérifie les paramêtre et on register
            if (isset($_POST['mailRegister']) && isset($_POST['passwordRegister']) && isset($_POST['firstnameRegister']) && isset($_POST['lastnameRegister'])) {
                $mail = $_POST['mailRegister'];
                $password = $_POST['passwordRegister'];
                $firstname = $_POST['firstnameRegister'];
                $lastname = $_POST['lastnameRegister'];
                $result = register($mail, $password, $firstname, $lastname);
                include('./App/view/debugView.php');
            }
            break;
        case 'logout':
            // Si c'est une déconnexion, on unset les variables de session + session destroy
            unset($_SESSION['mail']);
            session_destroy();
            break;
        default:
            echo "Erreur";
            break;
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Archives</a></li>
            <?php
            // Button de connexion si la var de session ma!l n'existe pas
            if (!isset($_SESSION['mail'])) {
                echo '
                <li>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">
                        Connexion
                    </button>
                </li>
                ';
            }

            ?>
        </ul>
        <?php

        //  button profil si la var de session mail existe
        if (isset($_SESSION['mail'])) {
            echo '
            <button id="profile" type="button" data-bs-toggle="modal" data-bs-target="#profilModal">
            <img src="./img/profile.svg" alt="">
            </button>
            ';
        }
        ?>
    </nav>

    <!-- Modal connexion -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Connectez vous</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="./index.php" method="POST">
                        <label for="mailLogin">Email :</label>
                        <input type="email" id="mailLogin" name="mailLogin" required><br><br>
                        <label for="passwordLogin">Mot de passe :</label>
                        <input type="password" id="passwordLogin" name="passwordLogin" required><br><br>
                        <input type="hidden" name="action" value="login">
                        <input type="submit" value="Se connecter">
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">
                        S'inscrire
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal inscription -->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Inscription</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form name="register" onsubmit="return validateForm()" action="index.php" method="POST">
                        <label for="mailRegister">Email :</label>
                        <input type="email" id="mailRegister" name="mailRegister" required><br><br>

                        <label for="firstname">Prénom :</label>
                        <input type="text" id="firstname" name="firstnameRegister" required><br><br>

                        <label for="lastname">Nom :</label>
                        <input type="text" id="lastname" name="lastnameRegister" required><br><br>

                        <label for="passwordRegister">Mot de passe :</label>
                        <input type="password" id="passwordRegister" name="passwordRegister" required><br><br>

                        <label for="confirmPassword">Confirmer le mot de passe:</label>
                        <input type="password" id="confirmPassword" required><br><br>

                        <input type="hidden" name="action" value="register">
                        <input type="submit" value="S'inscrire">
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                        Se connecter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section>

        <?php
        // Switch case pour Afficher les view
        if (isset($_SESSION['mail'])) {
            include('./App/view/profilModalView.php');
        }
        ?>

    </section>

    <script>
        function validateForm() {
            var password = document.forms["register"]["passwordRegister"].value;
            var confirmPassword = document.forms["register"]["confirmPassword"].value;
            if (password != confirmPassword) {
                alert("Les mots de passe ne correspondent pas.");
                return false;
            }
        }
    </script>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>