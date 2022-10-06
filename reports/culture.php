<?php

    $cultures=mysqli_query($con,"select * from culture_report where bdid='$id' limit 1") or die (mysqli_error());
    while($cul=mysqli_fetch_array($cultures)){
    	$specimen=$cul['specimen'];
    	$growth=$cul['growth'];
    	$microscopy=$cul['microscopy'];
    	$bacterial_growth=$cul['bacterial_growth'];
    	$zn_stain=$cul['zn_stain'];
    	$gram_stain=$cul['gram_stain'];
    }
    
    $content .= ' <table class="table table-striped table-hover table-md">
<tr>
<th><h2>Culture Report</h2></th>
</tr>
<br>
<tr>
<td width="40%" ><h4>Specimen</h4></td>
<td class="text-center" >'. $specimen .'
</td>
</tr>
<br>';
if( ! ( substr($growth, 0, 6) === "Select") ) {
$content .= '<tr>
<td width="40%"><h4>Growth</h4></td>
<td class="text-center" >'. $growth.'
</td>
</tr>
<br>';
}
if( ! ( substr($microscopy, 0, 6) === "Select") ) {
$content .= '<tr>
<td width="40%"><h4>Microscopy</h4></td>
<td class="text-center" >'.$microscopy.'
</td>
</tr>
<br>';}
if( ! ( substr($bacterial_growth, 0, 6) === "Select") ) {
$content .= '<tr>
<td width="40%"><h4>Bacterial Count / Growth</h4></td>
<td class="text-center" >'. $bacterial_growth.'
</td>
</tr>
<br>';}
if( ! ( substr($zn_stain, 0, 6) === "Select") ) {
$content .= '<tr>
<td width="40%"><h4>Z-N Stain</h4></td>
<td class="text-center" >'. $zn_stain .'
</td>
</tr>
<br>';}
if( ! ( substr($gram_stain, 0, 6) === "Select") ) {
$content .= '<tr>
<td width="40%"><h4>Gram\'s Stain</h4></td>
<td class="text-center" >'.$gram_stain .'
</td>
</tr>';}

$content .= ' </table>  ';



$medicines=mysqli_query($con,"select * from  medicine_details where bid='$bid'") or die (mysqli_error());
$rowcount=mysqli_num_rows($medicines);                  

if( $rowcount > 0 ) {
               
$content .= ' <div class="row mt-4">
<p align="left"><h2>ANTIMICROBIAL SENSITIVITY</h2></p>
                      
                      <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">';
                    
                      while($row=mysqli_fetch_array($medicines)){
                     
                      
                      $content .= '   <tr>
                        <td width="40%">'. $row['med'] .'</td>
                        <td class="text-center" >'. $row['c_result'] .'</td>
                        </tr>';
                    } 

                     $content .= ' </table>
                      <strong><h5> S = Sensitive, R = Resistant, I = Intermediate </h5> </strong>';
                            
}
