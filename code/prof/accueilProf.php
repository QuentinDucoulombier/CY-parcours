<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["pseudo"])){ /*pas certain que ce soit utile*/
      header('Location: ../connexion.php');
  }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acceuil</title>
        <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/> 
        <link rel="icon" type="image/png" href="../favicon.png"/>

    </head>
    <body>
        <?php
            
            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
           // $img = $_SESSION["image"];
           $img = $_SESSION["image"];
            echo "<h1>Bienvenue $prenom $nom vous etes $status</h1>";
            //echo "<img src=../$img></img>";
            echo "<a href=changerInfo.php><img src=$img></img></a>";
            
        ?>
        <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->
        <div id=menu>
            Menu    
            <ul>
                <li>test</li>
                <li>test2</li>
            </ul>
        </div>
        <div id=profil>

        </div>
        <p></p>
        
        <form method="POST" action="../connexion.php">
            <input type="submit" name="OUT" value="deconnexion"/>
        </form>
    </body>
</html>