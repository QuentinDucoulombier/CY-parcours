<?php
    session_start();
    $prenom =  $_SESSION["prenom"];
    $nom = $_SESSION['nom'];
    if(!file_exists("../../data/confirmation.txt"))
    {
        echo "Les options ont bien etait confirmé !";
        file_put_contents("../../data/confirmation.txt", "les options ont etait confirmé par $prenom $nom");
    }
    else
    {
        echo "Les choix ont deja etait confirmé";
    }
?>