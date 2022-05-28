<?php
    $option = $_POST["option"];
    $oldOption = $_POST["oldOption"];
    $filiere = $_POST["fil"];
    $eleve = $_POST["eleve"];

    function changement($fichier, $eleve, $filiere, $option)
    {
        $data = file_get_contents($fichier);
        $data_json = json_decode($data,TRUE);
        for ($i=0; $i < count($data_json); $i++) { 
            if ($data_json[$i]['eleve'] == $eleve) {
                if($data_json[$i]['option'][0] != $option)
                {
                    $data_json[$i]['option'][0] = $option;
                    echo "<p id=etatG>L'éleves a bien changé d'option</p>";
                }
                else
                {
                    echo "<p id=etatB>L'éleves est deja dans cette option</p>";
                }
            }

        }
        $final = json_encode($data_json);
        file_put_contents($fichier, $final);
    }


    if ($filiere == 'GSI') {
        changement("../../data/resultat1.json", $eleve, $filiere, $option);
    }
    elseif ($filiere == 'MI') {
        changement("../../data/resultat2.json", $eleve, $filiere, $option);
    }
    elseif ($filiere == 'MF') {
        changement("../../data/resultat3.json", $eleve, $filiere, $option);
    }
    else {
        echo "<p id ='etatB'>Erreur</p>";
    }


?>