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
        <title>Acceuil</title>
        <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
        <link rel="icon" type="image/png" href="../favicon.png"/>
        <script type="text/javascript" src="envoie.js"></script>

    </head>
    <body>
        <?php

            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $email = $_SESSION["email"];
            $status = $_SESSION["status"];
            $img = $_SESSION["image"];
            $filiere = $_SESSION["filiere"];
            echo "<h1>Bienvenue $prenom $nom vous etes $status</h1>";
            echo "<a href=changerInfo.php><img src=$img></img></a>";


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
<div id=menu>
 Menu <br>
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

        <div id=profil>

        </div>
        <h2>Saisir un bug ou un probleme</h2>
        <div id=ticket>
            <p>Titre <input type="text" name="titre" id="titre"></p>
            <textarea name="description" id="description" rows="12" cols="35">Faites la description de votre probleme.</textarea><br>
            <button type="button" onclick="envoyer()">Envoyer</button>
            <div id="etat">
            </div>
        </div>
        <div id="profil">
            <h2>Modifier votre profil :
            <a href="changerInfo.php">Ici</a></h2>
        </div>
        <p></p>

        <form method="POST" action="../connexion.php">
            <input type="submit" name="OUT" value="deconnexion"/>
            <!--TODO rajouter session_destroy()-->
        </form>
    </body>
</html>
