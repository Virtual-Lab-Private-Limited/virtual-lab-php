<?php

    $results=mysqli_query($con,"select * from  analysis_result where bdid='$id' order by priority asc ") or die (mysqli_error());
        $count_sub=mysqli_num_rows($results);

           $initial = 0;
     
            while($row=mysqli_fetch_array($results)) {
              $id = $row['id'];
              $testid = $row['testid'];
              $gid = $row['gid'];
              $pt = $row['ptid'];
              $left = $row['left_result'];
              $right = $row['right_result'];
              
        
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
              
          
              $tests=mysqli_query($con,"select * from  tests where id=$testid") or die (mysqli_error());
              while($r=mysqli_fetch_array($tests)){
                  $test_title = $r['title'];
                 
              }
       
            if( ! empty( $row['left_result']) ) {
            
                $output .= '<tr><td>'.$test_title.'</td><td>'.$left.'</td><td>'.$right.'</td></tr>';
        
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
    $date = '<h6 style="font-height:10px">'. $result[0].' '. $result[1].'</h6> ';

    $pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);
 
    // $pdf->write1DBarcode($bookingno, 'C39', 120, 70, 20, 10, 0.6, $style, 'N');
          
    $pdf->SetXY(117, 50);
    $pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);
$row1 = '';
$row2 = '';
$row3 = '';

      $content .= '    <col>
  <colgroup span="2"></colgroup>
  <colgroup span="2"></colgroup>
   
      <table class="table table-lg" >  
        <tr style="background-color: #ddd; line-height: 20px"  >  
        <th width="60%" style="font-weight:bold; vertical-align: middle;">Test</th>
        <th class="text-right" width="40%" style="font-weight:bold" colspan="2">Result</th>
        </tr><tr  style="background-color: #ddd; line-height: 20px" >
        <th width="50%" ></th>
        <th class="text-left" style="font-weight:bold" width="25%">Left</th>
        <th class="text-left"  style="font-weight:bold" width="25%"> Right</th></tr>';

      $content .= '';
        
      $content .= $output; 
      $content .= '</table>';  


?>