<form id="formComment" action="index.php?action=seepost" method="post">
    <input type="hidden" name="idpost" value="<?php echo $idpost ?>">
    <input type="hidden" name="action" value="addComment">
    <textarea name="comment" id="comment" rows="5" placeholder="Votre commentaire"></textarea>
    <input class="commentButton" type="submit" value="Envoyer">
</form>