<?php
    $tab = array(); //on cree un tableau temporaire
    $cpt = 0;
    $tailleAvant = filesize("../../data/error.csv");
    if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
            if ($data[3] != $_POST["bug"]) //on ne peut pas changer en theorie le mail et le nom
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
    /*on renvoie le meme programme*/
    $row=0;
    if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {
        echo "<div class='table-wrapper'>";
        echo "<table class='fl-table'>";
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $num = count($data);
            if($row == 0)
            {
                echo "<thead>";
                echo "<tr>";
                echo "<th>Numero</th>";
                for ($c=0; $c < $num; $c++) {
                    echo "<th>$data[$c]</th>";
                }
                echo "</tr>";
                echo "</thead>";
            }
            else
            {
                echo "<tbody>";
                echo "<tr>";
                echo "<td>$row</td>";
                for ($c=0; $c < $num; $c++) {
                    echo "<td>$data[$c]</td>";
                }
                echo "</tr>";
                echo "<tbody>";
            }
            $row++;
        }
        echo "<input type='hidden' id='rowPost' name='rowPost' value=$row>";
        $varApres = $row;
        fclose($handle);
    }
    echo "</table>";
    echo "</div>";
    
    if($_POST["rowPost"]>$varApres) /*On compare le nombre de ligne dans le .csv avant la modification et apres*/
    {
        echo "<p id=etatG>Ticket supprimé avec succés</p>"; /*Si c'est bien superieur avant alors le ticket a bien etait supprimé*/
    }
    else
    {
        echo "<p id=etatB>Erreur dans la suppression du ticket</p>"; /*Sinon il y a une eurreur*/
    }

?>
