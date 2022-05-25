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
        <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
        <link rel="icon" type="image/png" href="../favicon.png"/>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="admin.js"></script>

        <link rel="stylesheet" href="../messagerie/messagerie.css">
        <script src="../messagerie/messagerie.js"></script>
    </head>
    <body>

        <?php

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


            echo "<h1>Bienvenue $prenom $nom vous etes $status</h1>";
            //echo "<img src=../$img></img>";
            echo "<a href=changerInfo.php><img class='pp' src=$img></img></a>";

        ?>
        <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->


        <div id=createProfilEleve>
            <h2>Cree les profil eleves</h2>
            <button type="button" id="CreateEleve" onclick=test() >Lancer le programme</button>
            <div id=loading class="hidden">
                <p>Chargement merci de patienter ...</p>
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
                    echo "<table>";
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $num = count($data);
                        if($row == 0)
                        {
                            echo "<tr>";
                            echo "<th>Numero</th>";
                            for ($c=0; $c < $num; $c++) {
                                echo "<th>$data[$c]</th>";
                            }
                            echo "</tr>";
                        }
                        else
                        {
                            echo "<tr>";
                            echo "<td>$row</td>";
                            for ($c=0; $c < $num; $c++) {
                                echo "<td>$data[$c]</td>";
                            }
                            echo "</tr>";
                        }
                        $row++;
                    }
                    echo "<input type='hidden' id='rowPost' name='rowPost' value=$row>";
                    fclose($handle);
                }
                echo "</table>";
                echo "</div>";
            ?>
            <p></p>
            Ticket resolu :
            <?php
                echo "<input list='Bug' name='bug' id='bug'/>";
                $row=0;
                if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {
                    echo "<datalist id='Bug'>";
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $num = count($data);
                        if($row > 0)
                        {
                        echo "<option value=$data[3]>";
                        }
                        $row++;
                    }
                    fclose($handle);
                    echo "</datalist>";
                }
            ?>
            <button type="button" onclick="ticket()">Envoyer</button>
            <div id="etat">
            </div>



        </div>
        <div id="log">
            <h3>Log des modifications des profs</h3>
        </div>

        <div id="report">
            <h3>Signalement messagerie</h3>
            <?php
                $json = file_get_contents("../messagerie/logs/ticket_message.json",true);
                $array = json_decode($json,true);
                var_dump($array);
            ?>

        </div>
        <p></p>

        <div id="profil">
            <h2>Modifier votre profil :
            <a href="changerInfo.php">Ici</a></h2>
        </div>


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
            <input type="submit" name="OUT" value="Deconnexion"/>
        </form>



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
