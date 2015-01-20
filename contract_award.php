<?php
   // opening two files and putting the content in an array
        $fa = fopen('awards.csv', 'r');
        $fc = fopen('contracts.csv', 'r');
         while (($data = fgetcsv($fa, 0, ",")) !== FALSE){
            $awards[]=$data;
        }
        while (($data = fgetcsv($fc, 0, ",")) !== FALSE) {
                $contracts[]=$data;
        }
     // comparing and combining   
        for($x=0;$x<count($contracts);$x++)
        {
            if($x==0){
                unset($awards[0][0]);
                $line[$x]=array_merge($contracts[0],$awards[0]); //header
            }
            else{
                $ab=0;
                for($y=0;$y <= count($awards);$y++)
                {
                    if($awards[$y][0] == $contracts[$x][0]){
                        unset($awards[$y][0]);
                        $line[$x]=array_merge($contracts[$x],$awards[$y]);
                        $ab=1;
                    }           
                }
                if($ab==0)
                    $line[$x]=$contracts[$x];
            }
        }
    //final combined file  
        $ff = fopen('final.csv', 'w');//output file set here

        foreach ($line as $fields) {
            fputcsv($ff, $fields);
        }
        $sum=0;
        for($z=0; $z<=count($final);$z++){
            if($final[z][2]=="current"){
                $sum+=$final[z][13];
            }
            
        }
        
        echo"Total amount of current contracts:",$sum;
        fclose($fp);
        
?>
