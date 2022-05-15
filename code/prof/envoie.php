<?php
    $fichier = "../../data/error.csv";
    if(!file_exists($fichier))
    {
        $file = fopen($fichier,"w");
        $listeTitre = array("titre","description");
        fputcsv($file, $listeTitre, ";");
        fclose($file);

    }

    //on importe les infos de l'inscription dans un csv
    $file = fopen($fichier,"a");
    $list = array($_POST['titre'], $_POST['description']);
    fputcsv($file, $list, ";");
    fclose($file);
    echo "<p id='etatG'>Ticket envoyer avec succes !</p>";  
?>