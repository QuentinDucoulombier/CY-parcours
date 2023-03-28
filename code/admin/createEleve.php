<?php
    function rand_string( $length ) //fonction pour generer les mdp
    {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }

    function enregistre($fichier, $filiere)
    {
        if(filesize("../../data/loginEleves.csv")<50) //changer pour virer l'erreur
        {
            $row = 0;
            if (($handle = fopen($fichier, "r")) !== FALSE)
            {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
                {
                  $password = rand_string(8);
                    if(!file_exists("../../data/loginEleves.csv"))
                    {
                        $file = fopen("../../data/loginEleves.csv","w");
                        $listeTitre = array("Prenom","Nom","Email","Pseudo","Mdp","Statut","pp","filiere");
                        fputcsv($file, $listeTitre, ";");
                        fclose($file);  //jsuis juste un one head

                    }
                    else
                    {
                        $file = fopen("../../data/loginEleves.csv","a");
                        $pseudo = $data[0].$data[1];
                        if($row > 0){

                            $pp = "https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"; //cas ou l'utilisateur ne choisis pas de pp
                            $list = array($data[0], $data[1], $data[2], $pseudo, password_hash($password, PASSWORD_DEFAULT), "eleves", $pp, $filiere);
                            fputcsv($file, $list, ";");
                        }
                    }
                    if(!file_exists("../../data/loginElevesMail.csv"))
                    {
                        $file = fopen("../../data/loginElevesMail.csv","w");
                        $listeTitre = array("Identifiant","Email","Mdp");
                        fputcsv($file, $listeTitre, ";");
                        fclose($file);

                    }
                    else
                    {
                        $file = fopen("../../data/loginElevesMail.csv","a");
                        if($row > 0){
                            $list = array($pseudo, $data[2], $password);
                            fputcsv($file, $list, ";");
                        }
                    }
                    $row++;

                }
                fclose($file);
                echo "Le fichier a été créé avec succès !";
                exit();
            }
        }
        else
        {
            echo "Le fichier existe déjà !";
            exit();
        }
    }
    enregistre("../../data/choixEtudiantsParcours1.csv", "GSI");
    enregistre("../../data/choixEtudiantsParcours2.csv", "MF");
    enregistre("../../data/choixEtudiantsParcours3.csv", "MI");
?>
