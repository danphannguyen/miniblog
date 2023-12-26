<section id="adminPanel">

    <div id="adminWrapper Button">
        <button id="adminButtonUsers">Utilisateurs</button>
        <button id="adminButtonPosts">Articles</button>
        <button id="adminButtonComments">Commentaires</button>
    </div>

    <div id="adminWrapperUsers">

        <?php

        foreach ($users as $user) {
            echo '
            <div class="adminContentContainer">
                <div class="adminContentHeader">
                    <img src="' . $user['path_user'] . '" alt="">
                    <div>
                        <span>' . $user['firstname_user'] . '</span>
                        <span>' . $user['lastname_user'] . '</span>
                    </div>
                </div>

                <div class="adminContentTools">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal' . $user['id_user'] . '">
                        Edit
                    </button>
                    <form action="index.php?action=adminpanel" method="post">
                        <input type="hidden" name="action" value="deleteUser">
                        <input type="hidden" name="iduser" value="' . $user['id_user'] . '">
                        <input type="submit" value="delete">
                    </form>
                </div>
            </div>

            <div class="modal fade" id="userModal' . $user['id_user'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="editForm" action="index.php?action=adminpanel" method="post">
                            <label for="mailEdit">Email :</label>
                            <input type="email" id="mailEdit" name="mailEdit" value="' . $user['mail_user'] . '" required><br><br>
                    
                            <label for="firstname">Prénom :</label>
                            <input type="text" id="firstname" name="firstnameEdit" value="' . $user['firstname_user'] . '" required><br><br>
                    
                            <label for="lastname">Nom :</label>
                            <input type="text" id="lastname" name="lastnameEdit" value="' . $user['lastname_user'] . '" required><br><br>
                    
                            <label for="passwordEdit"> Nouveau mot de passe :</label>
                            <input type="password" id="passwordEdit" name="passwordEdit" required><br><br>
                    
                            <input type="hidden" name="iduser" value="' . $user['id_user'] . '">
                            <input type="hidden" name="action" value="editUser">
                            <input type="submit" value="Modifier">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        ';
        }

        ?>
    </div>

    <div id="adminWrapperPosts" class="d-none">

        <?php

        foreach ($posts as $post) {
            echo '
                <div class="adminContentContainer">
                    <div class="adminContentHeader">
                        <div>
                            <span>' . $post['title_articles'] . '</span>
                            <span>' . $post['date_articles'] . '</span>
                        </div>
                    </div>
        
                    <div class="adminContentTools">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal' . $post['id_articles'] . '">
                            Edit
                        </button>
                        <form action="index.php?action=adminpanel" method="post">
                            <input type="hidden" name="action" value="deletePost">
                            <input type="hidden" name="idpost" value="' . $post['id_articles'] . '">
                            <input type="submit" value="delete">
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="postModal' . $post['id_articles'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Article</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <form class="editForm" action="index.php?action=adminpanel" method="post">

                                <label for="editPostTitle">Titre :</label>
                                <input type="text" name="editPostTitle" value="' . $post['title_articles'] . '" required>

                                <br>

                                <label for="editPostContent">Contenu :</label>
                                <br>
                                <textarea name="editPostContent" rows="5" required>' . $post['content_articles'] . '</textarea>
                                <br>
                            
                                <input type="hidden" name="idpost" value="' . $post['id_articles'] . '">
                                <input type="hidden" name="action" value="editPost">
                                <input type="submit" value="Modifier">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                ';
        }

        ?>
    </div>

    <div id="adminWrapperComments" class="d-none">

        <?php

        foreach ($comments as $comment) {

            echo '
            <div class="adminContentContainer">
                <div class="adminContentHeader">
                    <div>
                        <span>' . $comment['firstname_user'] . '</span>
                        <span>' . $comment['lastname_user'] . '</span>
                    </div>
                    <span>' . $comment['date_comments'] . '</span>
                </div>

                <div class="adminContentTools">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentModal' . $comment['id_comments'] . '">
                        Edit
                    </button>
                    <form action="index.php?action=adminpanel" method="post">
                        <input type="hidden" name="action" value="deleteComment">
                        <input type="hidden" name="idcomment" value="' . $comment['id_comments'] . '">
                        <input type="submit" value="delete">
                    </form>
                </div>

                <div class="modal fade" id="commentModal' . $comment['id_comments'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Commentaire</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <form class="editForm" action="index.php?action=adminpanel" method="post">

                                <label for="editPostContent">Commentaire :</label>
                                <br>
                                <textarea name="editCommentContent" rows="5" required>' . $comment['content_comments'] . '</textarea>
                                <br>
                            
                                <input type="hidden" name="idcomment" value="' . $comment['id_comments'] . '">
                                <input type="hidden" name="action" value="editComment">
                                <input type="submit" value="Modifier">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }

        ?>

    </div>

</section>