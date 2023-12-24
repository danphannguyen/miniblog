<div class="dc-center">
    <h1>Écrivez votre article !</h1>
    <form action="index.php" method="POST">

        <input type="hidden" name="action" value="addPost">

        <input type="text" id="formPostTitle" name="formTitle" placeholder="Votre titre" required>

        <textarea id="formPostContent" class="auto-resize" name="formContent" rows="5" placeholder="Votre texte ici" required></textarea>

        <input class="Mbutton" type="submit" value="Envoyer">
    </form>
</div>