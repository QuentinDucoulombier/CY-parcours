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

        <link rel="stylesheet" href="../messagerie/messagerie.css">
        <script src="../messagerie/messagerie.js"></script>
    </head>
    <body>
        <?php

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
            
            echo "<h1>Bienvenue $prenom $nom vous etes $status</h1>";
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
<h2>Vos Datas</h2>
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

<div id=resultat>
    
    <?php
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
            }
            elseif ($filiere == 'MI') {
                affichOption("../../data/resultat2.json", $prenom, $nom);
            }
            elseif ($filiere == 'MF') {
                affichOption("../../data/resultat3.json", $prenom, $nom);
            }
            else {
                echo "<p id ='etatB'>Erreur</p>";
            }
        }
    ?>
</div>

<div id=ticket>
  <h2>Vous rencontrez un bug ou un problème ? Remplissez un ticket <a href="sendTicket.php">ici</a>.</h2>
</div>

        <div id="profil">
            <h2>Modifier votre profil :
            <a href="changerInfo.php">Ici</a></h2>
        </div>
        <p></p>
        
        <div id="messagerie-container">
            <div id="option-plus"  class="hidden">
                <div id="supprimer" class="">Suprimer</div>
                <div id="signaler" class="hidden">Signaler</div>
            </div>

            <form id="signalement" class="hidden">
                <p>Motif du signalement:</p>
                <select id="motif" >
                    <option>Méchant !</option>
                    <option>Très méchant :< </option>
                    <option>Vraiment très méchant 😡 GRAOUU ! </option>
                </select>
                <p>Descrition du signalement(facultatif):</p>
                <textarea id="description" rows="5" cols="33"></textarea>
                <div id="les-boutons">
                    <div>Signaler</div> <div onclick="annuler_signal()">Annuler</div>
                </div>
            </form>

            <div id="les-discussions">

                <select id="select-discussion" size="5">
                    <optgroup label="Professeurs">
                    <?php
                    if (($handle = fopen("../../data/loginProf.csv", "r")) !== FALSE) {
                        $data = fgetcsv($handle, 1000, ";");
                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            echo '<option onclick=nouv_autre("'.$data[1].'","'. $data[0].'","'.$data[2].'","'.$data[5].'") value="'.$data[0].' '. $data[1].'">'.$data[0].' '. $data[1].'</option>' ;
                        }
                        fclose($handle);
                    }
                    ?>
                    </optgroup>
                    <optgroup label="Eleves">
                    <?php
                    if (($handle = fopen("../../data/loginEleves.csv", "r")) !== FALSE) {
                        $data = fgetcsv($handle, 1000, ";");
                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            echo '<option onclick=nouv_autre("'.$data[1].'","'. $data[0].'","'.$data[2].'","'.$data[5].'") value="'.$data[0].' '. $data[1].'">'.$data[0].' '. $data[1].'</option>' ;
                        }

                        fclose($handle);
                    }
                    ?>
                    </optgroup>
                    <optgroup label="Admins">
                      <?php
                      if (($handle = fopen("../../data/loginAdmin.csv", "r")) !== FALSE) {
                          $data = fgetcsv($handle, 1000, ";");
                          while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                              echo '<option onclick=nouv_autre("'.$data[1].'","'. $data[0].'","'.$data[2].'","'.$data[5].'") value="'.$data[0].' '. $data[1].'">'.$data[0].' '. $data[1].'</option>' ;
                          }

                          fclose($handle);
                      }
                      ?>
                    </optgroup>
                </select>

            </div>

            <div id="la-discussion">
                <div id="message-zone">
                    <div class="message envoye">
                        <div class="premiere-ligne">
                            <p class="auteur">Jean Michel</p>
                            <div class="plus">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>

                        <p class="infos">18/04/2022 23:17:03</p>

                        <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde veniam aspernatur ducimus, dolor, temporibus magni explicabo voluptatem non totam itaque atque aut quos? Numquam, Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet inventore repellendus exercitationem corrupti excepturi! Veniam hic omnis, vel unde quos blanditiis atque perferendis! Nemo veritatis magnam laudantium incidunt. Autem, neque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim temporibus inventore sit adipisci ducimus deleniti quos nam repellendus asperiores. Eos alias, deserunt aperiam cum quisquam dolores iusto hic iste numquam? fugiat nesciunt deleniti doloremque reiciendis delectus. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam libero numquam vel illum dignissimos. Consectetur maiores repellendus quas placeat velit nemo atque ipsa earum! Modi quaerat itaque nisi quos consequatur. !</p>
                    </div>
                </div>
                <div id="bas-messagerie">
                    <div id="nouv-message">
                        <input id="message-text" type="text" value="">
                        <button onclick="nouveau_message()">Envoyer</button>
                    </div>
                    <div class="button-bloque-debloque" id="button-bloque" onclick="bloquer_utilisateur()">
                        Bloquer l'utilisateur
                    </div>
                    <div class="button-bloque-debloque hidden" id="button-debloque" onclick="debloquer_utilisateur()">
                        Débloquer l'utilisateur
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="../connexion.php">
            <input type="submit" name="OUT" value="deconnexion"/>
            <!--TODO rajouter session_destroy()-->
        </form>
        
        <!--Script pour actualiser-->
        <script>

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            async function verification_message() {
                recup_messages();
                //console.log(id_dernier_message);
                await sleep(1000);
                verification_message();
            }
            verification_message();
        </script>
    </body>
</html>
