# Cy Parkour
## Furger Achille, Lucas Thu Ping One, Quentin Ducoulombier, Noé Faucher

 
### Mise en place du serveur

Lancer le serveur dans le dossier `projet-devweb-main` (pour linux):
```bash
    php -S localhost:8080
```
Pour windows, instaler `wsl` et instaler un OS linux sur wsl et puis suivre les mêmes instructions que pour la mise en place du serveur pour le système linux ou suivre ce [tuto](https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/4237816-preparez-votre-environnement-de-travail#/id/r-4443612).


Puis mettre dans l'url dans le lien suivant :
```
localhost:8080/code/connexion.php 
```

### Utilisation du site

Vous pouvez ensuite créer un compte administrateur pour créer les identifiants des éleves, ou un compte responsable admission.
Les logins des eleves avec les mot de passe non encrypter seront dans le fichier "loginElevesMail.csv".
Une fois le(s) compte(s) créer vous pouvez connecter, et utiliser les fonctionalités uniques pour chaques types d'utilisateurs :

- Pour les admins : generer les login des élèves, afficher l'historique des changement d'option effectués par les responsables d'admission.

- Pour les responsables admission : envoyer des tickets a l'administrateur, lancer le mariage stable, changer les filieres de etudiants une fois le mariage stable effectué ou encore afficher les statistiques de chaque options.

- Pour les élèves : on peut également envoyer des tickets, afficher les resultats, afficher la moyenne et les voeux de l'etudiants.

- On retrouve également des fonctionalités commune a tout les types d'utilisateur, comme envoyer des messages, modifier son profil.
