<?php
$tab = array(); //on cree un tableau temporaire
$reste = array();
$new = array();
    $cpt = 0;
    if (($handle = fopen("../data/choixEtudiantsParcours1.csv", "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
            
            //for ($c=0; $c < $num; $c++) {
            if($cpt>0)
                $new = str_replace (",", ".",  $data[4]);
                array_push($tab, $new); //On enregistre dans un tableau les infos du .csv differente de celle de l'utilisateur modifier
                for ($c=0; $c < $num; $c++) {
                    array_push($reste, $data[$c]);
                }
            
           // }
            $cpt ++; //compte le nombre de ligne differente de celle de l'utilisateur modifier
        


        }
        fclose($handle);

    }
    
    
    function mergesort($numlist)
    {
        if(count($numlist) == 1 ) return $numlist;
     
        $mid = count($numlist) / 2;
        $left = array_slice($numlist, 0, $mid);
        $right = array_slice($numlist, $mid);
     
        $left = mergesort($left);
        $right = mergesort($right);
         
        return merge($left, $right);
    }
     
    function merge($left, $right)
    {
        $result=array();
        $leftIndex=0;
        $rightIndex=0;
     
        while($leftIndex<count($left) && $rightIndex<count($right))
        {
            if($left[$leftIndex]>$right[$rightIndex])
            {
     
                $result[]=$right[$rightIndex];
                $rightIndex++;
            }
            else
            {
                $result[]=$left[$leftIndex];
                $leftIndex++;
            }
        }
        while($leftIndex<count($left))
        {
            $result[]=$left[$leftIndex];
            $leftIndex++;
        }
        while($rightIndex<count($right))
        {
            $result[]=$right[$rightIndex];
            $rightIndex++;
        }
        return $result;
    }
    
    
    echo "<p></p>";
    echo "tableau 2";
    foreach (mergesort($tab) as $key => $value) {
        $new = str_replace (".", ",",  $value);
        echo $new."<br/>";
    }

    /*$file = fopen("../data/loginTest1.csv","w");
    foreach ((array_chunk($tab, ceil(count($tab) / $cpt))) as $value) { //array chunk permet de separet un tableau en plusieurs tableau (donc permet de separe le .csv en plusieurs lignes)
        fputcsv($file, $value, ";");                                    //lire https://www.php.net/manual/fr/function.array-chunk.php dans notre cas on prends la taille du tableau que l'on divise par le nombre d'utilisateur different de celui modifier
    }*/

    foreach ((array_chunk($reste, ceil(count($reste) / $cpt))) as $valuet) { //array chunk permet de separet un tableau en plusieurs tableau (donc permet de separe le .csv en plusieurs lignes)
        foreach (mergesort($tab) as $key => $value) {
            $new = str_replace (".", ",",  $value);
            echo $valuet[4];
            /*if ($new == $valuet[4]) {
                //echo "test";
                foreach ($valuet as $key => $valuett) {
                    echo $valuett."<br/>";
                }
            }*/
            
                
            
            
        }
            
        echo "<br/>"; 
    }
        
        
    
?>