<?php
    session_start();
    $prenom =  $_SESSION["prenom"];
    $nom = $_SESSION['nom'];
    if(!file_exists("../../data/confirmation.txt"))
    {
        echo "Les options ont bien été confirmées !";
        file_put_contents("../../data/confirmation.txt", "les options ont été confirmées par $prenom $nom");
    }
    else
    {
        echo "Les choix ont déjà été confirmés";
    }
?>
