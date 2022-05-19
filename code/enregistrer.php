<?php
    session_start();
    if ($_POST['statut'] == "Profs") {
        $fichier = "../data/loginProf.csv";
    }
    elseif ($_POST['statut'] == "Admin") {
        $fichier = "../data/loginAdmin.csv";
    }
    else
    {
        header('Location: inscription.html');
        exit();
    }

    if(!file_exists($fichier))
    {
        $file = fopen($fichier,"w");
        $listeTitre = array("Prenom","Nom","Email","pseudo","mdp","status", "pp");
        fputcsv($file, $listeTitre, ";");
        fclose($file);

    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //on importe les infos de l'inscription dans un csv
    $file = fopen($fichier,"a");
    if(!isset($_SESSION["pp"]))
    {
        $_SESSION["pp"] = "https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"; //cas ou l'utilisateur ne choisis pas de pp
    }
    $list = array($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['pseudo'], $password, $_POST['statut'], $_SESSION["pp"]);
    fputcsv($file, $list, ";");
    fclose($file);
    header('Location: connexion.php');
    exit();

?>
