<div class="parentGrid">

    <?php
    foreach ($posts as $post) {
        echo '<div class="divGrid">
                    <div class="dc-center divGridContainer">
                        <div>
                            <div class="GridTitleContainer">
                                <div>
                                    <h2>' . $post['title_articles'] . '</h2>
                                    <span>' . $post['firstname_user'] . ' ' . $post['lastname_user'] . '</span>
                                </div>
                                <span>' . $post['date_articles'] . '</span>
                            </div>
                            <p>' . $post['content_articles'] . '</p>
                        </div>
                        <form action="index.php?action=seepost" method="post">
                            <input type="hidden" name="idpost" value="' . $post['id_articles'] . '">
                            <input class="divGridButton" type="submit" value="En savoir Plus">
                        </form>
                    </div>
                </div>';
    }
    ?>

</div>