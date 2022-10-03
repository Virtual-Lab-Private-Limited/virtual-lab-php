<?php 

$results = mysqli_query($con, "select * from  histopathology_report where bdid='$id'") or die(mysqli_error());
while($row=mysqli_fetch_array($results)){       
    $organ=$row['organ'];
    $specimen=$row['specimen'];     
    $history_form=$row['history_form'];
    $gross=$row['gross'];        
    $microscopic=$row['microscopic'];
    $diagnosis=$row['diagnosis'];
    $history=$row['history'];
    $doctor=$row['doctor'];
  
}

$content .= ' 
<table class="table table-md">
<br>
<tr style="text-align:left" >
<td colspan="5" ><h2 >'. $title .'</h2></td>

</tr>
<tr>
        <td width="40%" class="text-left">Organ</td>
        <td class="text-right">'. $organ .'</td>  
</tr>
<tr>
        <td width="40%" class="text-left">Specimen</td>
        <td class="text-right">'. $specimen .'</td>  
</tr><tr>
        <td width="40%" class="text-left">History Form Attached</td>
        <td class="text-right">'. $history_form .'</td>  
</tr>

</table>
    
    <h4 style="margin-top:20px">Gross Examination:</h4>
    '. $gross.'
    <h4>Microscopic Examination:</h4>
    '. $microscopic .'
    <h4>Diagnosis:</h4>
    '. $diagnosis .'
    <h4>Pertinent History:</h4>
    '. $history .'


<div style="text-align:right">
       <strong>Electronic Signature:________________________</strong>

  </div>  ';

       $results = mysqli_query($con, "select * from  doctors where id='$doctor'") or die(mysqli_error());
       while($row=mysqli_fetch_array($results)){    
       $content .= ' 
          <div class="col-md-4" style="text-align:right">
          '. $row['firstname'].'  '.$row['lastname'] .' 
          '. $row['education'] .' 
        (Histopathology)  ';
    }
     

$content .= ' </div>
              
</div> ';
?>