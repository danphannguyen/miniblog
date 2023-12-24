 <!-- modal profil -->
 <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body dc-center">
                 <img id="modalPicture" src="<?php echo $_SESSION['profilePicture'] ?>" alt="">
                 <span>Prénom : <?php echo $_SESSION['firstname'] ?></span>
                 <span>Nom : <?php echo $_SESSION['lastname'] ?></span>
                 <span>Mail : <?php echo $_SESSION['mail'] ?></span>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <form action="index.php" method="post">
                     <input type="hidden" name="action" value="logout">
                     <button type="submit" class="btn disconnect" data-bs-dismiss="modal">Déconnexion</button>
                 </form>
             </div>
         </div>
     </div>
 </div>