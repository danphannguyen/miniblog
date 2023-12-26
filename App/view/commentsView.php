<section id="commentsSection">
    <div id="commentsContainer">
        <h3>Commentaires</h3>
        <div id="commentsWrap">

        <?php
            foreach ($comments as $comment) {
                echo '<div class="comment">
                        <div class="commentHeader">
                            <img src='. $comment['path_user'] .' alt="">
                            <div>
                                <span>' . $comment['firstname_user'] . ' ' . $comment['lastname_user'] . '</span>
                                <br>
                                <span>' . $comment['date_comments'] . '</span>
                            </div>
                        </div>
                        <p>' . $comment['content_comments'] . '</p>
                    </div>';
            }

        ?>
        </div>

        <button id="commentSeeMore" class="commentButton">See More</button>
</section>