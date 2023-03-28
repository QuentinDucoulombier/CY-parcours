<?php

$filiere = $_POST['filiere'];
if ($filiere == 'GSI') {
    echo "Moyenne des moyennes des GSI :";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "HPDA");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "HPDA");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "BI");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "BI");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "CS");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "CS");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "IAC");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "IAC");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "IAP");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "IAP");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "ICC");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "ICC");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "INEM");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "INEM");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "VISUA");
        echo afficher_voeux ("../../data/resultat1.json", "GSI", "VISUA");
        echo "<br>";
}
elseif ($filiere == 'MI') {
    echo "Moyenne des moyennes des MI :";
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "HPDA");
        echo afficher_voeux ("../../data/resultat2.json", "MI", "HPDA");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "BI");
        echo afficher_voeux ("../../data/resultat2.json", "MI", "BI");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "DS");
        echo afficher_voeux ("../../data/resultat2.json", "MI", "DS");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "FT");
        echo afficher_voeux ("../../data/resultat2.json", "MI", "FT");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "IAC");
        echo afficher_voeux ("../../data/resultat2.json", "MI", "IAC");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "IAP");
        echo afficher_voeux ("../../data/resultat2.json", "MI", "IAP");
        echo "<br>";
}
elseif ($filiere == 'MF') {
    echo "Moyenne des moyennes des MF :";
        echo moyenne_des_moyennes("../../data/resultat3.json", "MF", "ACTU");
        echo afficher_voeux ("../../data/resultat3.json", "MF", "ACTU");
        echo "<br>";
        echo moyenne_des_moyennes("../../data/resultat3.json", "MF", "MMF");
        echo afficher_voeux ("../../data/resultat3.json", "MF", "MMF");
        echo "<br>";
}
else {
    echo "<p id ='etatB'>Erreur</p>";
}
function moyenne_des_moyennes($fichier, $filiere, $option){
    $dividende = 0;
    $diviseur = 0;
    $bassemoyenne = 0;
    $rang_dividende = 0;
    $rang_diviseur = 0;

    $data = file_get_contents($fichier);
    $data_json = json_decode($data,TRUE);

    for ($i=0; $i < count($data_json); $i++) {
        if ($data_json[$i]['option'][0] == $option) {
            $dividende = $dividende + floatval(str_replace(',','.',$data_json[$i]['moyenne']));
            $diviseur++;
            $rang_dividende = $rang_dividende + $i+1;
            $rang_diviseur++;
            $bassemoyenne = floatval(str_replace(',','.',$data_json[$i]['moyenne']));
        }
    }
    echo "<ul>";
    echo "<li> La moyenne des " . $option . " (" . $filiere .  ") est " . ($dividende / $diviseur) . " </li>";
    echo "<li>La moyenne du dernier admis est " . $bassemoyenne . "</li>";
    echo "<li>La moyenne des rangs est " . ($rang_dividende / $rang_diviseur) . "</li>";
    echo "<li>Le nombre d'étudiants en " . $option . " est " . $rang_diviseur  . " </li>";
    echo "</ul>";
}

function afficher_voeux($fichier, $filiere, $option){

    $tab_gsi = ["HPDA"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0],"BI"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0],"CS"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0],"IAC"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0],"IAP"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0],"ICC"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0],"INEM"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0],"VISUA"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0]];
    $tab_mi = ["HPDA"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0],"BI"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0],"DS"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0],"FT"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0],"IAC"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0],"IAP"=>[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0]];
    $tab_mf = ["ACTU"=>[1=>0,2=>0],"MMF"=>[1=>0,2=>0]];

    $data = file_get_contents($fichier);
    $data_json = json_decode($data,TRUE);

    for ($i=0; $i < count($data_json); $i++) {
        if ($data_json[$i]['option'][0] == $option) {
            $email = $data_json[$i]['mail'];
            if (($eleve = fopen('../../data/choixEtudiantsParcours1.csv','r')) && ($filiere == "GSI")) {
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $voeux = 0;
                        for ($j=0; $j < 8; $j++) {
                            if ($option == explode(" ",$l[$j+5])[0]) {
                                $voeux = $j+1;
                            }
                        }
                        $tab_gsi[$option][$voeux]++;
                    }

                }
            }
            elseif (($eleve = fopen('../../data/choixEtudiantsParcours3.csv','r')) && ($filiere == "MI")) {
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $voeux = 0;
                        for ($j=0; $j < 6; $j++) {
                            if ($option == explode(" ",$l[$j+5])[0]) {
                                $voeux = $j+1;
                            }
                        }
                        $tab_mi[$option][$voeux]++;
                    }

                }
            }
            elseif (($eleve = fopen('../../data/choixEtudiantsParcours2.csv','r')) && ($filiere == "MF")) {
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $voeux = 0;
                        for ($j=0; $j < 2; $j++) {
                            if ($option == explode(" ",$l[$j+5])[0]) {
                                $voeux = $j+1;
                            }
                        }
                        $tab_mf[$option][$voeux]++;
                    }

                }
            }
        }
    }

    if ($filiere == 'GSI') {
        echo "Le nombre d'étudiants ayant eu " . $option . " en premier voeux est " . $tab_gsi[$option][1] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en deuxième voeux est " . $tab_gsi[$option][2] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en troisème voeux est " . $tab_gsi[$option][3] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en quatrième voeux est " . $tab_gsi[$option][4] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en cinquième voeux est " . $tab_gsi[$option][5] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en sixième voeux est " . $tab_gsi[$option][6] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en septième voeux est " . $tab_gsi[$option][7] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en huitième voeux est " . $tab_gsi[$option][8] . "<br>";
    }
    elseif ($filiere == 'MI') {
        echo "Le nombre d'étudiants ayant eu " . $option . " en premier voeux est " . $tab_mi[$option][1] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en deuxième voeux est " . $tab_mi[$option][2] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en troisème voeux est " . $tab_mi[$option][3] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en quatrième voeux est " . $tab_mi[$option][4] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en cinquième voeux est " . $tab_mi[$option][5] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en sixième voeux est " . $tab_mi[$option][6] . "<br>";
    }
    elseif ($filiere == 'MF') {
        echo "Le nombre d'étudiants ayant eu " . $option . " en premier voeux est " . $tab_mf[$option][1] . "<br>";
        echo "Le nombre d'étudiants ayant eu " . $option . " en deuxième voeux est " . $tab_mf[$option][2] . "<br>";
    }
}

?>
