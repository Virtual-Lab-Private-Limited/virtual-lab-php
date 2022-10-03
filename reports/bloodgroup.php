<?php

    $results=mysqli_query($con,"select * from  bloodgroup_result where bdid='$id' ") or die (mysqli_error());
    $count_sub=mysqli_num_rows($results);
           
                   
    while($row=mysqli_fetch_array($results)){

        $output .= '<tr><td>'.$title.'</td><td>'.$row['result'].'</td><td>'.$row['rh_factor'].'</td></tr>';
                
    }
$style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        
    if ($count_sub > 1) { 
       $header .= '<h3 align="left" style="font-weight:bold">'.$title.'</h3><br /><br />  ';
    }
   
    
  

 $content = '';  
 
      $content .= '  
   
      <table class="table table-md">  
        <tr style="background-color: #ddd; line-height: 25px">  
        <th width="50%" style="font-weight:bold">Test</th>
        <th class="text-left" width="25%" style="font-weight:bold">Blood Group</th>
        <th class="text-left" width="25%" style="font-weight:bold">Rh Factor</th>
        </tr>  ';  
      $content .= $output;  
      $content .= '</table>';  
?>