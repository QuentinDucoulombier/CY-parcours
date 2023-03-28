<html>
    <head>
        <script type="text/javascript" src="prof.js"></script>
    </head>
</html>
<?php
    $eleve = $_POST["eleve"];
    $filiere = $_POST["spe"];

    function optionEleve($fichier, $eleve, $filiere)
    {
        $data = file_get_contents($fichier);
        $data_json = json_decode($data,TRUE);
        for ($i=0; $i < count($data_json); $i++) { 
            if ($data_json[$i]['eleve'] == $eleve) {
                $oldOption = $data_json[$i]['option'][0];
                echo "<input type='hidden' id='oldOption' value=$oldOption>";
                echo "<input type='hidden' id='filiere' value=$filiere>";
                echo "<input type='hidden' id='eleve' value=$eleve>";
                echo "$eleve est en ".$oldOption."<br/>";
                
                echo "Veuillez choisir une nouvelle option : <br/>";
                if($filiere == "GSI")
                {
                    echo "<select name='option' id='option'>";
                        echo "<option value='HPDA' >HPDA</option>";
                        echo "<option value='BI' >BI</option>";
                        echo "<option value='CS' >CS</option>";
                        echo "<option value='IAC' >IAC</option>";
                        echo "<option value='IAP' >IAP</option>";
                        echo "<option value='ICC' >ICC</option>";
                        echo "<option value='INEM' >INEM</option>";
                        echo "<option value='VISUA' >VISUA</option>";
                    echo "</select>";
                    echo "<button onclick='final()'>Valider</button>";
                }
                elseif ($filiere == "MI") {
                    echo "<select name='option' id='option'>";
                        echo "<option value='HPDA' >HPDA</option>";
                        echo "<option value='BI' >BI</option>";
                        echo "<option value='DS' >DS</option>";
                        echo "<option value='FT' >FT</option>";
                        echo "<option value='IAC' >IAC</option>";
                        echo "<option value='IAP' >IAP</option>";
                    echo "</select>";
                    echo "<button onclick='final()'>Valider</button>";
                }
                elseif ($filiere == "MF") {
                    echo "<select name='option' id='option'>";
                        echo "<option value='ACTU' >ACTU</option>";
                        echo "<option value='MMF' >MMF</option>";
                    echo "</select>";
                    echo "<button onclick='final()'>Valider</button>";
                }
                else {
                    echo "<p id ='etatB'>Erreur</p>";
                }
            }
        
        }
    }


    if ($filiere == 'GSI') {
        optionEleve("../../data/resultat1.json", $eleve, $filiere);
    }
    elseif ($filiere == 'MI') {
        optionEleve("../../data/resultat2.json", $eleve, $filiere);
    }
    elseif ($filiere == 'MF') {
        optionEleve("../../data/resultat3.json", $eleve, $filiere);
    }
    else {
        echo "<p id ='etatB'>Erreur</p>";
    }

?>