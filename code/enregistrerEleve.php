<?php
//TODO verifier si le nom existe dans la base de donner (je sais comme faire)
//AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH CA MARCHE PAS
    session_start();
    function enregistre($fichier)
    {
        //if (($eleve = fopen("../data/loginEleves", "r")) !== FALSE) {
            if (($handle = fopen($fichier, "r")) !== FALSE) {
                //
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {


                        if (($data[2] == $_POST["email"]) && ($data[1] == $_POST["nom"])){ //&& ($dataEleve[2] != $_POST["email"]) && ($dataEleves[1] != $_POST["nom"])){  //On verifie si son adresse mail et son nom existe dans la base de donnée

                            if(!file_exists("../data/loginEleves.csv"))
                            {
                                $file = fopen("../data/loginEleves.csv","w");
                                $listeTitre = array("Prenom","Nom","Email","pseudo","mdp","status", "pp");
                                fputcsv($file, $listeTitre, ";");
                                fclose("../data/loginEleves.csv");

                            }//mettre un else ici puis tester avec un if
                            else {
                              if (($eleve = fopen("../data/loginEleves.csv", "r")) !== FALSE) {
                                while (($dataEleve = fgetcsv($eleve, 1000, ";")) !== FALSE) {
                                  if (($dataEleve[2] == $_POST["email"]) && ($dataEleve[1] == $_POST["nom"])){
                                    header('Location: inscription.html');
                                  }
                                  else
                                  {
                                    $file = fopen("../data/loginEleves.csv","a");
                                    if(!isset($_SESSION["pp"]))
                                    {
                                        $_SESSION["pp"] = "https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"; //cas ou l'utilisateur ne choisis pas de pp
                                    }
                                    $list = array($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['pseudo'], $_POST['password'], "eleves", $_SESSION["pp"]);
                                    fputcsv($file, $list, ";");
                                    fclose($file);
                                    header('Location: connexion.php');
                                    exit();

                                  }
                                }
                              }
                            }

                            //on importe les infos de l'inscription dans un csv
                        }
                        else
                        {
                          header('Location: inscription.html'); //TODO mettre un msg d'erreur (en ajax en gros)
                        }
                    }
                    fclose($handle);

                fclose($eleve);
            }

    }
    enregistre("../data/choixEtudiantsParcours1.csv");
    enregistre("../data/choixEtudiantsParcours2.csv");
    enregistre("../data/choixEtudiantsParcours3.csv");
?>
