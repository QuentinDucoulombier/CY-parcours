<html>
    <head>
        <script type="text/javascript" src="prof.js"></script>
    </head>
</html>
<?php

                function afficherEleves($fichier,$spe)
                {
                    $data = file_get_contents($fichier);
                    $data_json = json_decode($data,TRUE);
                    $tailleJson = count($data_json) + 1;
                    echo "<input type='hidden' id='spe'  value=$spe>";
                    echo "<select name='listEleve' id='listEleve' size=10>";
                    echo "<option value=''>Eleves de la spécialité $spe</option>"; //pas sur de l'orthographe
                    
                    for ($i=0; $i < count($data_json); $i++) { 
                        //if ($data_json[$i]['option'][0] == $option) {
                        echo "<option value=".$data_json[$i]['eleve']." onclick='test()'>".$data_json[$i]['eleve']."</option>";
                                            
                        //}
                    }
                    echo "</select>";
                }
                $filiere = $_POST['filiere'];
                if ($filiere == 'GSI') {
                    afficherEleves("../../data/resultat1.json","GSI");
                }
                elseif ($filiere == 'MI') {
                    afficherEleves("../../data/resultat2.json","MI");
                }
                elseif ($filiere == 'MF') {
                    afficherEleves("../../data/resultat3.json","MF");
                }
                else {
                    echo "<p id ='etatB'>Erreur</p>";
                }


               /* $dataGSI = file_get_contents("../../data/resultat1.json");
                $dataMI = file_get_contents("../../data/resultat2.json");
                $dataMF = file_get_contents("../../data/resultat3.json");
                $data_jsonGSI = json_decode($dataGSI,TRUE);
                $data_jsonMI = json_decode($dataMI,TRUE);
                $data_jsonMF = json_decode($dataMF,TRUE);
                //$data_jsonT = array();
                array_push($data_jsonGSI, $data_jsonMI);
                $tailleJson = count($data_jsonGSI) + 1;
                echo "<select name='listEleve' id='listEleve' size=$tailleJson>";
                echo "<option value=''>Eleves</option>"; //pas sur de l'orthographe
                
                for ($i=0; $i < count($data_jsonGSI); $i++) { 
                    //if ($data_json[$i]['option'][0] == $option) {
                    echo "<option value=".$data_jsonGSI[$i]['eleve']." onclick='test()'>".$data_jsonGSI[$i]['eleve']."</option>";
                                        
                    //}
                }
                echo "</select>";*/
               

            ?>