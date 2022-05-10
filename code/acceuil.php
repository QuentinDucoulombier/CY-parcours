<!--peut etre assemenbler les pages comme dans le cm7-->
<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["pseudo"])){
      header('Location: connexion.php');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acceuil</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>

    </head>
    <body>
        <?php
            if($_SESSION["status"] == "prof")
            {
                header('Location: prof/accueilProf.php');
            }
            else if($_SESSION["status"] == "admin")
            {
                header('Location: admin/accueilAdmin.php');
            }
            else
            {
                header('Location: eleve/accueilEleves.php');
            }
            /*$prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            echo "<h1>Bienvenue $prenom $nom<h1>";*/
        ?>
        <p></p>
        <form method="POST" action="connexion.php">
            <input type="submit" name="OUT" value="deconnexion"/>
            
        </form>

    </body>
</html>

<!-- test de la brancheette -->