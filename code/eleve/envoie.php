<?php
    $fichier = "../../data/error.csv";
    if(!file_exists($fichier))
    {
        $file = fopen($fichier,"w");
        $listeTitre = array("titre","description");
        fputcsv($file, $listeTitre, ";");
        fclose($file);

    }

    $titre = str_replace (" ", "_",  $_POST['titre']);
    //on importe les infos de l'inscription dans un csv
    $file = fopen($fichier,"a");
    $list = array($titre, $_POST['description']);
    fputcsv($file, $list, ";");
    fclose($file);
    echo "<p id='etatG'>Ticket envoyer avec succes !</p>";  
?>