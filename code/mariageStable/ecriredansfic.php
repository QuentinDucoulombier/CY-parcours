<?php
    $text = $_GET["letext"];
    $path = $_GET["path"];
    $delim =  $_GET["delim"];

    

    
    if($path == "../../data/choixEtudiantsParcours1.csv"){
        $nb_col= 13;
    }elseif($path == "../../data/choixEtudiantsParcours2.csv"){
        $nb_col= 7;
    }else{
        $nb_col = 11 ;
    }

    echo "aazdad".$text;
    $tab = explode(';',$text);
    print_r($tab);

    $str="";
    $i=0;
    foreach($tab as $case){
        if($i % $nb_col == 0 && $i!=0){ 
            $str = $str ."\n".$case;
        }elseif($i==0){
            $str = $case;
        }else{
            $str =$str.";". $case;
        }
        $i++;
    }



    file_put_contents($path,$str,FILE_USE_INCLUDE_PATH);
    // echo $str;

?>