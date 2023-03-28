<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["pseudo"])){ /*pas certain que ce soit utile*/
      header('Location: ../connexion.php');
  }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acceuil</title>
        <link rel="icon" type="image/png" href="../favicon.png"/>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="admin.js"></script>


    </head>
    <body>

        <?php
            include "../menu.php";
            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
            $img = $_SESSION["image"];
            $email = $_SESSION["email"];
            //Creation de l'eleves en json
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

        ?>


        <div id=createProfilEleve>
            <h2>Créer les profils des élèves</h2>
            <button class="bouton"  type="button" id="CreateEleve" onclick=test() >Lancer le programme</button>
            <div id=loading class="hidden">
                <p>Chargement, merci de patienter ...</p>
                En attendant vous pouvez rigoler ici :<button onclick="popup()">Fun</button><br />
                <div class="loadingio-spinner-double-ring-lroiipoijrl"><div class="ldio-ys48lrawjtg">
                <div></div>
                <div></div>
                <div><div></div></div>
                <div><div></div></div>
                </div></div>

            </div>
        </div>

        <h2>Tableau de bord</h2>
        <div id=modif>
            <h3>Ticket/erreur</h3>
            <?php
                echo "<div id='actualisation'>";
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
                            echo "<th>Numéro</th>";
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
                    fclose($handle);
                }
                echo "</table>";
                echo "</div>";
                echo "</div>";
            ?>

            Ticket résolu :

            <?php
                echo "<select name='bug' id='bug'>";
                echo "<option value=''>Ticket à supprimer</option>";
                $row=0;
                if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {

                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $num = count($data);
                        if($row > 0)
                        {
                        echo "<option value=$data[3]>$data[3]</option>";
                        }
                        $row++;
                    }
                    fclose($handle);

                }
                echo "</select>";
            ?>
            <button class="bouton" id="envoyer" type="button" onclick="ticket()">Envoyer</button>
            <div id="etat">
            </div>



        </div>
        <p></p>
        <div id="log">
        <p></p>
            <?php
                $row=0;
                if(file_exists("../../data/logOption.csv"))
                {
                    echo "<h3>Log des modifications des profs</h3>";

                    if (($handle = fopen("../../data/logOption.csv", "r")) !== FALSE) {
                        echo "<div class='table-wrapper'>";
                        echo "<table class='fl-table'>";
                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            $num = count($data);
                            if($row == 0)
                            {
                                echo "<thead>";
                                echo "<tr>";
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
                                for ($c=0; $c < $num; $c++) {
                                    echo "<td>$data[$c]</td>";
                                }
                                echo "</tr>";
                                echo "</tbody>";
                            }
                            $row++;
                        }
                        fclose($handle);
                    }
                    echo "</table>";
                    echo "</tab>";
                }

            ?>
            </div>
        </div>

        <div id="report">
            <h3>Signalement messagerie</h3>
            <?php


                $data = file_get_contents("../messagerie/logs/ticket_message.json");
                $data_json = json_decode($data,TRUE);
                $taille = $data_json["nb_ticket"];

                echo "<div class='table-wrapper'>";
                echo "<table class='fl-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Date</th>";
                echo "<th>Auteur</th>";
                echo "<th>Signalé par</th>";
                echo "<th>Motif</th>";
                echo "<th>Description</th>";
                echo "</tr>";
                echo "</thead>";

                for ($i=0; $i < $taille ; $i++) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>".$data_json['tickets'][$i]['message']['infos']['date']." ".$data_json['tickets'][$i]['message']['infos']['heure']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['message']['auteur']['statut']." : ".$data_json['tickets'][$i]['message']['auteur']['nom']." ".$data_json['tickets'][$i]['message']['auteur']['prenom']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['message']['destinataire']['statut']." : ".$data_json['tickets'][$i]['message']['destinataire']['nom']." ".$data_json['tickets'][$i]['message']['destinataire']['prenom']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['motif']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['description']."</td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
                echo "</table>";
                echo "</tab>";

            ?>

        </div>


    </body>
</html>
