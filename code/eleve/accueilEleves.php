<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["nom"])){ /*pas certain que ce soit utile*/
      header('Location: ../connexion.php');
  }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
        <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
        <link rel="icon" type="image/png" href="../favicon.png"/>

    </head>
    <body>
        <?php
            include "../menu.php";
            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $email = $_SESSION["email"];
            $status = $_SESSION["status"];
            $img = $_SESSION["image"];
            $filiere = $_SESSION["filiere"];
            $_SESSION["user"] ='{
                "nom":"'.$nom.'",
                "prenom":"'.$prenom.'",
                "adresse_mail":"'.$email.'",
                "statut":"'.$status.'"
            }';
            $_SESSION["autre"] =  '{
                "nom":"Grandisson",
                "prenom":"Brewal",
                "adresse_mail":"Lajeunesse@cytech.fr",
                "statut":"eleve"
            }';

            echo "<h1>Bienvenue $prenom $nom</h1>";
            echo "<a href=changerInfo.php><img class='pp' src=$img></img></a>";


         if (($eleve = fopen('../../data/choixEtudiantsParcours1.csv','r')) && ($filiere == "GSI")) {
           while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
               if($email == $l[2]){
                   $moyenne = $l[4];
                   $ects = $l[3];
                   $choix = [$l[5],$l[6],$l[7],$l[8],$l[9],$l[10],$l[11],$l[12]];
                   $nbChoix = 8;
                 }
             }
         }
         if (($eleve = fopen('../../data/choixEtudiantsParcours2.csv','r')) && ($filiere == "MF")){
             while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                 if($email == $l[2]){
                     $moyenne = $l[4];
                     $ects = $l[3];
                     $choix = [$l[5],$l[6]];
                     $nbChoix = 2;
                 }
             }
         }
         if (($eleve = fopen('../../data/choixEtudiantsParcours3.csv','r')) && ($filiere == "MI")) { //on peut faire une fonction la pour que ce soit plus propre en sah
             while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                 if($email == $l[2]){
                     $moyenne = $l[4];
                     $ects = $l[3];
                     $choix = [$l[5],$l[6],$l[7],$l[8],$l[9],$l[10]];
                     $nbChoix = 6;
                 }
             }
         }

      ?>
<!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->
<div id=infosData>
<h2>Vos infos : </h2>
 <ul>
     <li>Votre moyenne : <span><?php echo $moyenne; ?></span></li>
     <li>Vos ECTS : <span><?php echo $ects; ?></span></li>
     <li>Vos options :<ul>
       <?php
       for ($i = 0; $i < $nbChoix; $i++) {
         $j = $i+1;
         echo "<li>Choix $j : <span> $choix[$i] </span></li>";
       }
       ?>
     </ul>
   </li>
 </ul>
</div>


    </body>
</html>
