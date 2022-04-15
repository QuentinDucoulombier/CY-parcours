<?php
session_start();

if (($handle = fopen("../data/loginEleves.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1024, ";")) !== FALSE) {

        if (($data[3] == $_POST["pseudo"]) && ($data[4] == $_POST["password"])){
            //on recupere les infos dans la session
            $_SESSION["prenom"] = $data[0];
            $_SESSION["nom"] = $data[1];
            $_SESSION["email"] = $data[2];
            $_SESSION["pseudo"] = $data[3];
            $_SESSION["password"] = $data[4];
            header('Location: acceuil.php');
            exit();
        }
        else
        {
        header('Location: connexion.php');
        }
    }
    fclose($handle);

}

?>