<!DOCTYPE html>
<?php
  session_start();

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acceuil</title>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
        <link rel="icon" type="image/png" href="../favicon.png"/>

    </head>
    <body>
        <?php
            
            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
            echo "<h1>Bienvenue $prenom $nom vous etes $status<h1>";
        ?>
        <p></p>
    </body>
</html>