<?php

function dbConnect()
{
    return new PDO('mysql:host=localhost;dbname=miniblog;port=8889,charest=utf8', 'root', 'root');
}

// Fonction de connexion
function connexion($mail, $password)
{
    if (isMailExist($mail)) {
        if (passwordCheck($mail, $password)) {
            bindUserInfo($mail);
            return "Connexion réussie";
        } else {
            return "Mauvais mot de passe";
        }
    } else {
        return "Mauvaise adresse mail";
    }
}

// Fonction d'inscription
function register($mail, $password, $firstname, $lastname, $path)
{
    if (isMailExist($mail)) {
        return "L adresse mail existe déjà";
    } else {
        if (addUser($mail, $password, $firstname, $lastname, $path)) {
            return 'Inscription réussie';
        } else {
            return 'Erreur lors de l inscription';
        }
    }
}

// Vérification de l'existence de l'adresse mail
function isMailExist($mail)
{
    $db = dbConnect();

    $query = "SELECT mail_user FROM users where mail_user = :mail";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    return !empty($result);
}

// Vérification du mot de passe
function passwordCheck($mail, $password)
{
    $db = dbConnect();

    $query = "SELECT password_user FROM users where mail_user = :mail";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->execute();
    // renvoyer seulement le PDO statement
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    return password_verify($password, $result[0]['password_user']);
}

function bindUserInfo($mail)
{

    $db = dbConnect();

    $query = "SELECT * FROM users where mail_user = :mail";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->execute();
    // renvoyer seulement le PDO statement
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    $_SESSION['id'] = $result[0]['id_user'];
    $_SESSION['mail'] = $result[0]['mail_user'];
    $_SESSION['firstname'] = $result[0]['firstname_user'];
    $_SESSION['lastname'] = $result[0]['lastname_user'];
    $_SESSION['profilePicture'] = $result[0]['path_user'];
    $_SESSION['role'] = $result[0]['role_user'];

    return isset($_SESSION['mail'], $_SESSION['firstname'], $_SESSION['lastname']);
}

// Ajout d'un utilisateur
function addUser($mail, $password, $firstname, $lastname, $path)
{

    $db = dbConnect();

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (mail_user, password_user, firstname_user, lastname_user, path_user) VALUES (:mail, :pswd, :firstname, :lastname, :path)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->bindValue(":pswd", $hash, PDO::PARAM_STR);
    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindValue(":path", $path, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();
}

// Ajout d'une image
function addImage($mail, $image)
{
    $uploadDir = "uploads/";
    $newFileName = $mail . ".png";
    $uploadFile = $uploadDir . basename($newFileName);

    // Déplacez le fichier vers le répertoire d'upload
    if (move_uploaded_file($image, $uploadFile)) {
        return $uploadFile;
    } else {
        return "";
    }
}

// Ajout d'un article
function addPost($id, $title, $content)
{
    $db = dbConnect();

    $query = "INSERT INTO articles (date_articles, title_articles, content_articles, ext_user) VALUES (:dateA, :title, :content, :id)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":dateA", date("Y-m-d H:i:s"), PDO::PARAM_STR);
    $stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();
}

// Récupération des 6 premiers articles
function getPostsOverview()
{
    $db = dbConnect();

    $query = "SELECT articles.*, users.firstname_user, users.lastname_user
    FROM articles
    JOIN users ON articles.ext_user = users.id_user
    ORDER BY articles.date_articles DESC
    LIMIT 6;
    ";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function getAllPosts()
{
    $db = dbConnect();

    $query = "SELECT articles.*, users.firstname_user, users.lastname_user
    FROM articles
    JOIN users ON articles.ext_user = users.id_user
    ORDER BY articles.date_articles DESC;
    ";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function getPost($id)
{
    $db = dbConnect();

    $query = "SELECT articles.*, users.firstname_user, users.lastname_user
    FROM articles
    JOIN users ON articles.ext_user = users.id_user
    WHERE articles.id_articles = :id;
    ";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function getAllComments($id)
{
    $db = dbConnect();

    $query = "SELECT comments.*, users.firstname_user, users.lastname_user, users.path_user
    FROM comments
    JOIN users ON comments.ext_user = users.id_user
    WHERE comments.ext_article = :id
    ORDER BY comments.date_comments DESC;
    ";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function addComment($userId, $postId, $content)
{
    $db = dbConnect();

    $query = "INSERT INTO comments (content_comments, date_comments, ext_user, ext_article) VALUES (:content, :dateC, :id, :idpost)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->bindValue(":dateC", date("Y-m-d H:i:s"), PDO::PARAM_STR);
    $stmt->bindValue(":id", $userId, PDO::PARAM_STR);
    $stmt->bindValue(":idpost", $postId, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();
}

function getAllUsers()
{
    $db = dbConnect();

    $query = "SELECT * FROM users";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function deleteUser($id_user) {

    $db = dbConnect();

    $query = "DELETE FROM users WHERE id_user = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id_user, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);

}

function editUser($id_user, $mail, $firstname, $lastname, $password) {

    $db = dbConnect();

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET mail_user = :mail, password_user = :pswd, firstname_user = :firstname, lastname_user = :lastname WHERE id_user = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->bindValue(":pswd", $hash, PDO::PARAM_STR);
    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id_user, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();

}

function editPost($id_post, $title, $content) {

    $db = dbConnect();

    $query = "UPDATE articles SET title_articles = :title, content_articles = :content WHERE id_articles = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id_post, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();

}

function deletePost($id_post) {

    $db = dbConnect();

    $query = "DELETE FROM articles WHERE id_articles = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id_post, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);

}

function getAdminAllComments() {
        $db = dbConnect();
    
        $query = "SELECT comments.*, users.firstname_user, users.lastname_user, users.path_user, articles.title_articles
        FROM comments
        JOIN users ON comments.ext_user = users.id_user
        JOIN articles ON comments.ext_article = articles.id_articles
        ORDER BY comments.date_comments DESC;
        ";
        $stmt = $db->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function editComment($id_comment, $content) {

    $db = dbConnect();

    $query = "UPDATE comments SET content_comments = :content WHERE id_comments = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id_comment, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();

}

function deleteComment($id_comment) {

    $db = dbConnect();

    $query = "DELETE FROM comments WHERE id_comments = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id_comment, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);

}
