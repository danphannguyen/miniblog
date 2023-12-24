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
            include('./App/view/loginView.php');
            break;
        case 'register':
            // Si c'est un register on vérifie les paramêtre et on register
            if (isset($_POST['mailRegister']) && isset($_POST['passwordRegister']) && isset($_POST['firstnameRegister']) && isset($_POST['lastnameRegister'])) {

                // par défaut on remet l'icone de base
                $path = "./img/profile.svg";

                if (isset($_FILES["profileFile"]) && $_FILES["profileFile"]["error"] == 0) {
                    $path = addImage($mail, $_FILES["profileFile"]["tmp_name"]);
                }

                $result = register($_POST['mailRegister'], $_POST['passwordRegister'], $_POST['firstnameRegister'], $_POST['lastnameRegister'], $path);
                include('./App/view/loginView.php');
            }
            break;
        case 'logout':
            // Si c'est une déconnexion, on unset les variables de session + session destroy
            unset($_SESSION['id']);
            unset($_SESSION['mail']);
            unset($_SESSION['firstname']);
            unset($_SESSION['lastname']);
            unset($_SESSION['profilePicture']);
            session_destroy();
            break;
        case 'addPost':
            // Si c'est un addPost on ajoute l'article
            if (isset($_POST['formTitle']) && isset($_POST['formContent'])) {
                $result = addPost($_SESSION['id'], $_POST['formTitle'], $_POST['formContent']);
            }
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
        <a href="#" class="navLink">
            <div class="dc-center">
                <span class='bgNavSvg'><img class="navSvg" src="./img/archive.svg" alt=""></span>
                <span>Archives</span>
            </div>
        </a>

        <a href="./index.php" class="navLink">
            <div class="dc-center">
                <span class='bgNavSvg'><img class="navSvg" src="./img/rainbow.svg" alt=""></span>
                <span>Accueil</span>
            </div>
        </a>

        <?php
        // Button de connexion si la var de session ma!l n'existe pas
        if (!isset($_SESSION['mail'])) {
            echo '
                    <button id="connexion" class="dc-center navLink" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">
                        <span class="bgNavSvg"><img class="navSvg" src="./img/profile.svg" alt=""></span>
                        <span>Connexion</span>
                    </button>
                ';
        }

        //  button profil si la var de session mail existe
        if (isset($_SESSION['mail'])) {
            echo "
                <button id='profile' class='dc-center navLink' type='button' data-bs-toggle='modal' data-bs-target='#profilModal'>
                    <img id='profilePicture' class='navSvg' src='{$_SESSION['profilePicture']}' alt=''>
                    <span>Profile</span>
                </button>
            ";
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

                    <form name="register" onsubmit="return validateForm()" action="index.php" method="post" enctype="multipart/form-data">
                        <label for="profileFile">Photo de profil :</label>
                        <input type="file" name="profileFile" id="profileFile"><br><br>

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

    <section id="contentSection">

        <?php
        // Switch case pour Afficher les view
        if (isset($_SESSION['mail'])) {

            // Affichage de la modal profile
            include('./App/view/profilModalView.php');

            // Si action est set
            if (isset($_GET['action'])) {

                // Et que l'action n'est pas write on affiche lien vers write
                if ($_GET['action'] != 'write') {
                    include('./App/view/WALinkView.php');
                }

                switch ($_GET['action']) {
                    case 'write':
                        include('./App/view/WAView.php');
                        break;
                    case 'read':
                        break;
                    default:
                        echo "Erreur";
                        break;
                }

            } else {

                // Affiche le bouton pour ajouter un article
                include('./App/view/WALinkView.php');

            }
        }

        ?>

    </section>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./src/script.js"></script>

</html>