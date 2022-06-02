<?php
session_start();

function connexEleves($fichier)
{
    if (($handle = fopen($fichier, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1024, ";")) !== FALSE) {

            if (($data[3] == $_POST["pseudo"]) && (password_verify($_POST["password"], $data[4]))){
                //on recupere les infos dans la session
                $_SESSION["prenom"] = $data[0];
                $_SESSION["nom"] = $data[1];
                $_SESSION["email"] = $data[2];
                $_SESSION["pseudo"] = $data[3];
                $_SESSION["password"] = $data[4];
                $_SESSION["status"] = $data[5];
                $_SESSION["image"] = $data[6];
                $_SESSION["filiere"] = $data[7  ];
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

function connexAutre($fichier)
{
    if (($handle = fopen($fichier, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1024, ";")) !== FALSE) {

            if (($data[3] == $_POST["pseudo"]) && (password_verify($_POST["password"], $data[4]))){
                //on recupere les infos dans la session
                $_SESSION["prenom"] = $data[0];
                $_SESSION["nom"] = $data[1];
                $_SESSION["email"] = $data[2];
                $_SESSION["pseudo"] = $data[3];
                $_SESSION["password"] = $data[4];
                $_SESSION["status"] = $data[5];
                $_SESSION["image"] = $data[6];
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
$eleve = "../data/loginEleves.csv";
if(file_exists($eleve))
{
    connexEleves($eleve);
}
connexAutre("../data/loginProf.csv");
connexAutre("../data/loginAdmin.csv");
header('Location: connexion.php');
?>
