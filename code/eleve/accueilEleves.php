<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["nom"])){ /*pas certain que ce soit utile*/
      header('Location: ../connexion.php');
  }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acceuil</title>
        <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
        <link rel="icon" type="image/png" href="../favicon.png"/>
        <script type="text/javascript" src="envoie.js"></script>

    </head>
    <body>
        <?php
            
            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
            $img = $_SESSION["image"];
            echo "<h1>Bienvenue $prenom $nom vous etes $status</h1>";
            echo "<a href=changerInfo.php><img src=$img></img></a>";
        ?>
         <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->
        <div id=menu>
            <h2>Menu</h2>
            <ul>
                <li>test</li>
                <li>test2</li>
            </ul>
        </div>
        <div id=profil>

        </div>
        <h2>Saisir un bug ou un probleme</h2>
        <div id=ticket>
            <p>Titre <input type="text" name="titre" id="titre"></p>
            <textarea name="description" id="description" rows="12" cols="35">Faites la description de votre probleme.</textarea><br>
            <button type="button" onclick="envoyer()">Envoyer</button>
            <div id="etat">
            </div>
        </div>
        <div id="profil">
            <h2>Modifier votre profil : 
            <a href="changerInfo.php">Ici</a></h2>
        </div>
        <p></p>
        
        <form method="POST" action="../connexion.php">
            <input type="submit" name="OUT" value="deconnexion"/>
            <!--TODO rajouter session_destroy()-->
        </form>
    </body>
</html>