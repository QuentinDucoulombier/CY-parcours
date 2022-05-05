<?php
session_start();

function connex($fichier)
{
    if (($handle = fopen($fichier, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1024, ";")) !== FALSE) {

            if (($data[3] == $_POST["pseudo"]) && ($data[4] == $_POST["password"])){
                //on recupere les infos dans la session
                $_SESSION["prenom"] = $data[0];
                $_SESSION["nom"] = $data[1];
                $_SESSION["email"] = $data[2];
                $_SESSION["pseudo"] = $data[3];
                $_SESSION["password"] = $data[4];
                $_SESSION["status"] = $data[5];
                $_SESSION["image"] = $data[6];
                $_SESSION["filiere"] = $data[7];
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
}
connex("../data/loginEleves.csv");
connex("../data/loginProf.csv");

?>
