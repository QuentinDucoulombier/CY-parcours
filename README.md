# Cy Parkour
## Furger Achille, Lucas Thu Ping One, Quentin Ducoulombier, Noé Faucher

 
### Mise en place du serveur

Lancer le serveur dans le dossier `projet-devweb-main` (pour linux):
```bash
    php -S localhost:8080
```
Pour windows, installer `wsl` et installer un OS linux sur wsl puis suivre les mêmes instructions que pour la mise en place du serveur pour le système linux ou suivre ce [tuto](https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/4237816-preparez-votre-environnement-de-travail#/id/r-4443612).


Puis mettre dans l'url dans le lien suivant :
```
localhost:8080/code/connexion.php 
```

### Utilisation du site

Vous pouvez ensuite créer un compte administrateur pour créer les identifiants des élèves, ou un compte responsable admission.
Les logins des élèves avec les mots de passe non encryptés seront dans le fichier "loginElevesMail.csv".
Une fois le(s) compte(s) créer vous pouvez connecter, et utiliser les fonctionalités uniques pour chaque type d'utilisateur :

- Pour les admins : générer les logins des élèves, afficher l'historique des changements d'option effectués par les responsables d'admission.

- Pour les responsables admission : envoyer des tickets à l'administrateur, lancer le mariage stable, changer les filières des étudiants une fois le mariage stable effectué ou encore afficher les statistiques de chaque option.

- Pour les élèves : on peut également envoyer des tickets, afficher les résultats, afficher la moyenne et les voeux de l'étudiant.

On retrouve également des fonctionalités communes à tous les types d'utilisateurs, comme envoyer des messages ou modifier son profil.
