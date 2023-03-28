<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <link rel="stylesheet" href="../messagerie/messagerie.css">
    <script src="../messagerie/messagerie.js"></script>
</head>
<body>
    <?php include "../menu.php"; ?>

    <?php
    session_start();

    $prenom =  $_SESSION["prenom"];
    $nom = $_SESSION["nom"];
    $status = $_SESSION["status"];
    $img = $_SESSION["image"];
    $email = $_SESSION["email"];
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

    ?>

    <div id="messagerie-container">
            <div id="option-plus"  class="hidden">
                <div id="supprimer" class="b">Suprimer</div>
                <div id="signaler" class="hidden b">Signaler</div>
            </div>

            <form id="signalement" class="hidden">
                <p>Motif du signalement:</p>
                <select id="motif" >
                    <option>Insulte</option>
                    <option>Harcelement </option>
                    <option>Autre</option>
                </select>
                <p>Descrition du signalement(facultatif):</p>
                <textarea id="description" rows="5" cols="33"></textarea>
                <div id="les-boutons">
                    <div class="b">Signaler</div> <div class="b" onclick="annuler_signal()">Annuler</div>
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
                    <div class="button-bloque-debloque b" id="button-bloque" onclick="bloquer_utilisateur()">
                        Bloquer l'utilisateur
                    </div>
                    <div class="button-bloque-debloque hidden b" id="button-debloque" onclick="debloquer_utilisateur()">
                        Débloquer l'utilisateur
                    </div>
                </div>
            </div>
        </div>

</body>


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
</html>
