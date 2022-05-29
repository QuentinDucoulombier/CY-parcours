<?php

$filiere = $_POST['filiere'];
if ($filiere == 'GSI') {
    echo "Moyenne des moyennes des GSI :";
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "HPDA");
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "BI");
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "CS");
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "IAC");
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "IAP");
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "ICC");
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "INEM");
        echo moyenne_des_moyennes("../../data/resultat1.json", "GSI", "VISUA");
        echo "<br>";
}
elseif ($filiere == 'MI') {
    echo "Moyenne des moyennes des MI :";
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "HPDA");
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "BI");
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "DS");
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "FT");
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "IAC");
        echo moyenne_des_moyennes("../../data/resultat2.json", "MI", "IAP");
        echo "<br>";
}
elseif ($filiere == 'MF') {
    echo "Moyenne des moyennes des MF :";
        echo moyenne_des_moyennes("../../data/resultat3.json", "MF", "ACTU");
        echo moyenne_des_moyennes("../../data/resultat3.json", "MF", "MMF");
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

?>