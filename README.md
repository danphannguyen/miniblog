# miniblog

!!! Comme discuté en cours, tout les utilisateurs loggués peuvent écrire des articles ( forums ) !!!

Compte admin :
admin@gmail.com
admin01

Compte utilisateur : 
test@gmail.com
toto01

Fontionnalités :
==== Accueil ====
- Affichage des 6 derniers posts
- Connexion / inscription
- Accès à l'archive
- ( si loggué ) Boutton (+) permettant d'écrire son post
  
==== Archives ====
- Permet de visualiser tout les posts

==== Post ====
- Permet de visualiser le l'auteur, la date, l'heure, le contenu du post
- Permet de voir les derniers commentaires
- Permet de voir tout les commentaires du post
- ( si loggué ) permet de ajouter un commentaire

==== Écriture du post ====
- On peut écrire et envoyer son post
- disparition du bouton + pour ne pas gêner

==== Logs ==== 
- Lors de certaines actions, des réponses a titre indicatif peuvent apparaître en haut du site

==== Sécurité ====
- Toute les requêtes sont faite avec bindValue empéchant les injections SQL
- Pour toutes les commandes Admin, on revérifie les permissions ce qui empèche que quelqu'un connaissant l'url puisse executer des commandes sans permissions

==== Admin Panel ====
- Modification et Suppression d'utilisateurs
- Modification et Suppression d'Articles
- Modification et Suppression de Commentaires
  
URL de l'admin panel : ?action=adminpanel