<?php
    $tab = array(); //on cree un tableau temporaire
    $cpt = 0;       
    $tailleAvant = filesize("../../data/error.csv");
    if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
            if ($data[0] != $_POST["bug"]) //on ne peut pas changer en theorie le mail et le nom
            {
                for ($c=0; $c < $num; $c++) {
                    
                    array_push($tab, $data[$c]); //On enregistre dans un tableau les infos du .csv differente de celle de l'utilisateur modifier
                    
                }
                $cpt ++; //compte le nombre de ligne differente de celle de l'utilisateur modifier
            }
            
            
        }
        fclose($handle);
    
    }
    /*on ecrase et recrit les ancienne info dans le loginAdmin.csv*/
    $file = fopen("../../data/error.csv","w");
    foreach ((array_chunk($tab, ceil(count($tab) / $cpt))) as $value) { //array chunk permet de separet un tableau en plusieurs tableau (donc permet de separe le .csv en plusieurs lignes)
        fputcsv($file, $value, ";");                                    //lire https://www.php.net/manual/fr/function.array-chunk.php dans notre cas on prends la taille du tableau que l'on divise par le nombre d'utilisateur different de celui modifier
    }
    
    fclose($file);
    $tailleApres = filesize("../../data/error.csv");
    if($tailleAvant<$tailleApres) //ca marche pas + s'inspirer de l'ancien ajax pour enelever en direct
    {
        echo "<p id='etatG'>Ticket supprimé</p>";
    }
    else
    {
        echo "<p id='etatB'>Erreur dans la suppression du ticket</p>";
    }
    
?>