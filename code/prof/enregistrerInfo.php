<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Le Titre</title>
        
    </head>
    <body>
        <h1>prout</h1>
        <?php
            $_SESSION["prenom"] = $_POST['prenom'];
            $_SESSION["nom"] = $_POST['nom']; 
            $_SESSION["email"]= $_POST['email'];
            $_SESSION["pseudo"]= $_POST['pseudo'];
            $_SESSION["password"]= $_POST['password'];
            $_SESSION["status"] = "prof";
            $_SESSION["image"] =  $_SESSION["pp"];
            echo "$prenom $nom $email $pseudo $password";
            $file = fopen("../../data/loginProf.csv","a"); //TODO modifier la bonne lignes
            if(!isset($_SESSION["pp"]))
            {
                $_SESSION["pp"] = "https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"; //cas ou l'utilisateur ne choisis pas de pp
            }
            $list = array($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['pseudo'], $_POST['password'], "prof", $_SESSION["pp"]);
            fputcsv($file, $list, ";");
            fclose($file);
            header('Location: changerInfo.php');
            exit();

        ?>
        
       
    </body>
    
</html>