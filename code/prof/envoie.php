<?php
session_start();
$fichier = "../../data/error.csv";
$date = date("F j, Y, g:i:s a");

if(!file_exists($fichier))
{
    $file = fopen($fichier,"w");
    $listeTitre = array("Date", "Prenom", "Nom", "Titre","Description");
    fputcsv($file, $listeTitre, ";");
    fclose($file);

}

$titre = str_replace (" ", "_",  $_POST['titre']);
//on importe les infos de l'inscription dans un csv
$file = fopen($fichier,"a");
$list = array($date, $_SESSION["prenom"], $_SESSION["nom"], $titre, $_POST['description']);
fputcsv($file, $list, ";");
fclose($file);
echo "<p id='etatG'>Ticket envoyé avec succès !</p>";
?>
