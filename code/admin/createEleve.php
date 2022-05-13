<?php
    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    
    }

    function enregistre($fichier)
    {
        $row = 0;
        if (($handle = fopen($fichier, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if(!file_exists("../../data/loginEleves.csv"))
                {
                    $file = fopen("../../data/loginEleves.csv","w");
                    $listeTitre = array("Prenom","Nom","Email","Mdp","Statut", "pp");
                    fputcsv($file, $listeTitre, ";");
                    fclose("../../data/loginEleves.csv");  //regarder pk il me gronde ici

                }
                $file = fopen("../../data/loginEleves.csv","a");
                if($row > 0){
                    if(!isset($_SESSION["pp"]))
                    {
                        $_SESSION["pp"] = "https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"; //cas ou l'utilisateur ne choisis pas de pp
                    }
                    $list = array($data[0], $data[1], $data[2], rand_string(8), "eleves", $_SESSION["pp"]);
                    fputcsv($file, $list, ";");
                }
                $row++;
                
            }
            fclose($file);
            header('Location: accueilAdmin.php');
            exit();
        }
    }
    enregistre("../../data/choixEtudiantsParcours1.csv");
    enregistre("../../data/choixEtudiantsParcours2.csv");
    enregistre("../../data/choixEtudiantsParcours3.csv");
?>