<section id="affichePost">
    <div id="afficheTitleContainer">
        <div>
            <h2> <?php echo $post[0]['title_articles'] ?> </h2>
            <span> <?php echo $post[0]['firstname_user'] . ' ' . $post[0]['lastname_user'] ?> </span>
        </div>
        <span> <?php echo $post[0]['date_articles'] ?> </span>
    </div>
    <p> <?php echo $post[0]['content_articles'] ?> </p>
</section>