<?php
session_start();
 $prenom =  $_SESSION["prenom"];
 $nom = $_SESSION["nom"];
 $email = $_SESSION["email"];
 $status = $_SESSION["status"];
 $img = $_SESSION["image"];
 $filiere = $_SESSION["filiere"]; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
    <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
</head>
<body>
<div id=resultat style="text-align: center;">
    
    <?php
        include "../menu.php";
        function affichOption($fichier, $prenom, $nom)
        {
            $nomJson = $prenom."_".$nom;
            $data = file_get_contents($fichier);
            $data_json = json_decode($data,TRUE);
            for ($i=0; $i < count($data_json); $i++) { 
                if ($data_json[$i]['eleve'] == $nomJson) {
                    echo "<p><strong>Felicitation, vous avez etait accepté dans l'option : ".$data_json[$i]['option'][0]." !!</strong></p>";
                }
            }
        }



        if(file_exists("../../data/confirmation.txt"))
        {
            echo "<h2>Vos resultats</h2>";
            if ($filiere == 'GSI') {
                affichOption("../../data/resultat1.json", $prenom, $nom);
                echo "<img src='https://acegif.com/wp-content/uploads/2020/05/confetti.gif' alt='confetti'>";
            }
            elseif ($filiere == 'MI') {
                affichOption("../../data/resultat2.json", $prenom, $nom);
                echo "<img src='https://acegif.com/wp-content/uploads/2020/05/confetti.gif' alt='confetti'>";
            }
            elseif ($filiere == 'MF') {
                affichOption("../../data/resultat3.json", $prenom, $nom);
                echo "<img src='https://acegif.com/wp-content/uploads/2020/05/confetti.gif' alt='confetti'>";
            }
            else {
                echo "<p id ='etatB'>Erreur</p>";
            }
        }
    ?>
    
</div>

</body>
</html>