<?php

                        $results=mysqli_query($con,"select * from  value_based_result where bdid='$id' order by priority asc ") or die (mysqli_error());
                        $count_sub=mysqli_num_rows($results);
                      
                        $initial = 0;
                 
                        while($row=mysqli_fetch_array($results)) {
                          $id = $row['id'];
                          $testid = $row['testid'];
                          $gid = $row['gid'];
                          $pt = $row['ptid'];
                           
                       
                            if($gid > 0 && ($initial != $gid)  ) {
                              
                                $level1 = mysqli_query($con, "select * from groups where id='$gid'") or die(mysqli_error());
                                while ($group = mysqli_fetch_array($level1)) {
                                       $groupid = $group['group_id'];
                                       $level2 = mysqli_query($con, "select * from tests where id='$groupid' limit 1") or die(mysqli_error());
                                        while ($test = mysqli_fetch_array($level2)) {
                                                $groupname = $test['title'];
                                        }
                                }
                               
                                $output .= '<br><tr><td colspan=5 style="font-weight:bold">'.$groupname.'</td></tr>';
                                $initial = $gid;
                            }
                          
                          $test_title = '';
                          $tests=mysqli_query($con,"select * from  tests where id=$testid") or die (mysqli_error());
                          while($r=mysqli_fetch_array($tests)){
                              $test_title = $r['title'];
                              $unit = $r['unit'];
                          }
                       
                            $refrence_value = '';
                            
                              
                            $references = mysqli_query($con, "select * from test_reference where testid='$testid' and gender='$gender' limit 1") or die(mysqli_error($con));
                            $rowcount=mysqli_num_rows($references);
                              
                        
                            if ( $rowcount > 0)
                            {
                                while ($ref1 = mysqli_fetch_array($references)) {
                                    $refrence_value = $ref1['minimum_value'] . ' - ' . $ref1['maximum_value'];
                                }
                        
                            } else {
                         
                                $reference = '';
                                $reference = mysqli_query($con, "select * from test_reference where testid='$testid' and additional_data != ''  limit 1") or die(mysqli_error($con));
                                while ($ref2 = mysqli_fetch_array($reference)) {
                                    $refrence_value =  $ref2['additional_data']  ;
                                    
                                }
                                
                           
                            }
                            
                           
                            if( ! empty( $row['value']) ) {
                        
                            $output .= '<tr><td>'.$test_title.'</td><td>'.$refrence_value.'</td><td>'.$unit.'</td><td>'.$row['value'].'</td>';
                            
                            $records = mysqli_query($con, "select * from value_based_result where ptid='$pt' and testid='$testid' and id <='$id' order by id DESC  limit 3 ") or die(mysqli_error());
                            $row = mysqli_fetch_assoc($records);
                            
                            $bookings = [];
                            $dates = [];
                            $i = 0;
                            while($record=mysqli_fetch_array($records)){ 
                                 
                                $output .= '<td >'.  $record['value'].' </td>';
                                $b_id = $record['bid'];
                                $boogs = mysqli_query($con, "select * from bookings where id='$b_id' limit 1") or die(mysqli_error());
                                while ($data = mysqli_fetch_array($boogs)) {
                                    $bno = $data['bookingno'];
                                    $tdate = $data['test_date'];
                                }
                                $bookings[$i] = $bno;
                                $dates[$i] = $tdate;
                                $i++;
                            } 
                         
                            $output .= '</tr>';
                    
                        }
                    }
                    
                    $content = '';  
 // define barcode style
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
       $header .= '<h2 align="left" style="font-weight:bold; text-decoration: underline;">'.$title.'</h2><br/>';
    } else {
        
        $level1 = mysqli_query($con, "select * from tests where id='$testid' ") or die(mysqli_error());
        while($t=mysqli_fetch_array($level1)) {
            $pid =  $t['pid'];
        }
       
        if ($pid > 0){
            $level2 = mysqli_query($con, "select * from tests where id='$pid' ") or die(mysqli_error());
            while($t=mysqli_fetch_array($level2)) {
                  $header .= '<h2 align="left" style="font-weight:bold; text-decoration: underline;">'.$t['title'].'</h2><br/>  ';
            }
        }

    }
    
    $split = explode(' ', $test_date); // Split up the whole string
    $chunks = array_chunk($split, 3);
    $result = array_map(function($chunk) { return implode(' ', $chunk); }, $chunks);
    // $date = '<h6 style="font-height:10px">'. $result[0].'</h6> ';

    $pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);
 
    // $pdf->write1DBarcode($bookingno, 'C39', 120, 70, 20, 10, 0.6, $style, 'N');
          
    // $pdf->SetXY(123, 80);
    // $pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);
$row1 = '';
$row2 = '';
$row3 = '';

      $content .= '   
      <table class="table table-lg" style="margin-bottom: 10%;" >  
        <tr style="background-color: #ddd; line-height: 20px"  >  
        <th width="30%" style="font-weight:bold; vertical-align: middle;">Test</th>
        <th class="text-left" width="15%" style="font-weight:bold">Reference Value</th>
        <th class="text-left" width="15%" style="font-weight:bold">Unit</th>
        <th class="text-left" width="15%" style="font-weight:bold"> <tr>Results</tr> </th>';
    
    $row1 .= '
        <tr style="background-color: #ddd; font-size: 6px"> 
        <td colspan="3"></td>
        <th class="text-left" scope="col">'.$result[0].'</th>';
    $row2 .= '
        <tr style="background-color: #ddd; font-size: 6px"> 
        <td colspan="3"></td>
        <th class="text-left" scope="col">'.$result[1].'</th>';
   
    $row3 .= '
        <tr style="background-color: #ddd; font-size: 6px; "> 
        <td colspan="3"></td>
        <th class="text-left" scope="col">'.$bookingno.'</th>';
                       
        if(count($bookings) == 1){ 
            
            // $pdf->write1DBarcode($bookings[0], 'C39', 150, 70, 20, 10, 0.4, $style, 'N');
            // $pdf->SetXY(153, 80);
            
            $split = explode(' ', $dates[0]); // Split up the whole string
            $chunks = array_chunk($split, 3);
            $result = array_map(function($chunk) { return implode(' ', $chunk); }, $chunks);
            // $date = '<h6 style="font-height:10px">'. $result[0].'</h6> ';
            // $pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);

            $content .= '<th class="text-left" width="20%" style="font-weight:bold"> Results</th>';
            $row1 .= '<th class="text-left" width="20%" > '.$result[0].'</th>';
            $row2 .= '<th class="text-left" width="20%" > '.$result[1].'</th>';
            $row3 .= '<th class="text-left" width="20%" > '.$bookings[0].'</th>';
       
       } 
        else if(count($bookings) >= 2) { 
            
            // $pdf->write1DBarcode($bookings[0], 'C39', 150, 70, 20, 10, 0.4, $style, 'N');
            // $pdf->SetXY(153, 80);
            $split = explode(' ', $dates[0]); // Split up the whole string
            $chunks = array_chunk($split, 3);
            $result = array_map(function($chunk) { return implode(' ', $chunk); }, $chunks);
            // $date = '<h6 style="font-height:10px">'. $result[0].'</h6> ';
            $row1 .= '<th class="text-left" width="15%" > '.$result[0].'</th>';
            $row2 .= '<th class="text-left" width="15%" > '.$result[1].'</th>';
            $row3 .= '<th class="text-left" width="15%" > '.$bookings[0].'</th>';
            // $pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);

            // $pdf->write1DBarcode($bookings[1], 'C39', 177, 70, 20, 10, 0.4, $style, 'N');
            // $pdf->SetXY(180, 80);
            $split = explode(' ', $dates[1]); // Split up the whole string
            $chunks = array_chunk($split, 3);
            $result = array_map(function($chunk) { return implode(' ', $chunk); }, $chunks);
            // $date = '<h6 style="font-height:10px">'. $result[0].'</h6> ';

            $row1 .= '<th class="text-left" width="15%" > '.$result[0].'</th>';
            $row2 .= '<th class="text-left" width="15%" > '.$result[1].'</th>';
            $row3 .= '<th class="text-left" width="15%" > '.$bookings[1].'</th>';
            //$pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);

            $content .= '<th class="text-left" width="15%" style="font-weight:bold"> Results</th>';
            $content .= '<th class="text-left" width="15%" style="font-weight:bold" > Results</th>';
          
     }

         $content .= '</tr>';
         $row1 .= '</tr>';
         $row2 .= '</tr>';
         $row3 .= '</tr>';

      $content .= $row1;
      $content .= $row2;
      $content .= $row3;
      $content .= $output; 
      $content .= '</table>';  


?>