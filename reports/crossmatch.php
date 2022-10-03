<?php

	$cross_matchs=mysqli_query($con,"select * from  crossmatch_result where bdid='$id' limit 1") or die (mysqli_error($con));
    while($cm=mysqli_fetch_array($cross_matchs)){
        $rec_name=$cm['rec_name'];
        $rec_blood_group=$cm['rec_blood_group'];
        $donor_name=$cm['donor_name'];
        $donor_blood_group=$cm['donor_blood_group'];
        $donor_hbsag=$cm['donor_hbsag'];
        $donor_anti_hcv=$cm['donor_anti_hcv'];
        $donor_anti_hiv=$cm['donor_anti_hiv'];
        $donor_vdrl=$cm['donor_vdrl'];
        $donor_malarial=$cm['donor_malarial'];
        $donor_hemoglobin=$cm['donor_hemoglobin'];
        $donor_platelets=$cm['donor_platelets'];
        $blood_bag_no=$cm['blood_bag_no'];
        $date_of_bleeding=$cm['date_of_bleeding'];
        $component=$cm['component'];
        $compatibility=$cm['compatibility'];        
    }

      $content .= '   <table class="table" >
        <tr><th  class="text-left" ><h2>Recipient Information</h2></th></tr>
        <br>
        <tr >
<th class="text-left" width="25%">Recipient Name</th> 
<td class="text-center" width="25%"><i>'.$rec_name.'</i></td>
<th class="text-left" width="35%" >Recipient Blood Group</th>
<td class="text-center" width="25%"><i>'. $rec_blood_group .'</i></td>
</tr>
<br>
<tr><th colspan="5" class="text-left" ><h2>Donor Information</h2></th></tr>
<br>            
<tr >
<th class="text-left" width="25%">Donor Name</th> 
<td class="text-center" width="25%"><i>'.$donor_name.'</i></td>
<th class="text-left" width="35%">Donor Blood Group</th>
<td class="text-center" width="25%"><i>'. $donor_blood_group .'</i></td>
</tr>
</table>
<table  style="border-spacing: 0 20px;">

<tr><th class="text-left"><h2>Donor\'s Tests</h2></th></tr>

<tr>
<th width="20%">HBsAg</th>';

if(((float)$donor_hbsag)<1){ 
    $content .= '<td width="20%"><i>Non-Reactive</i></td>'; 
    
} else {
    $content .= '<td width="20%"><i>Reactive</i></td>';
}

$content .= '<th width="20%">Donor Value</th>
<td width="15%"><i>'. $donor_hbsag .'</i></td>
<th width="25%">Cutt off Value</th>
<td width="10%"><i>1</i></td>
</tr>

<tr><th width="20%">Anti HCV</th><td width="20%"><i>';
if(((float)$donor_anti_hcv)<1){ $content .= 'Non-Reactive'; } else{ $content .= 'Reactive';}

$content .= '</i></td>
<th width="20%">Donor Value</th>
<td width="15%"><i>'. $donor_anti_hcv .'</i></td>
<th width="25%">Cutt off Value</th>
<td width="10%"><i>1</i></td>
</tr>

<tr><th width="20%">Anti HIV</th><td width="20%"><i>';

if(((float)$donor_anti_hiv)<1){ $content .= 'Non-Reactive'; } else { $content .= 'Reactive';}

$content .='
</i></td>
<th width="20%">Donor Value</th>
<td width="15%"><i>'. $donor_anti_hiv .'</i></td>
<th width="25%">Cutt off Value</th>
<td width="10%"><i>1</i></td>
</tr>

<tr>
<th>V.D.R.L</th>
<td><i>'. $donor_vdrl .'</i></td>
<th>Hemoglobin</th>
<td><i>'. $donor_hemoglobin .'</i></td>
</tr>

<tr>
<th>Malarial Parasite</th>
<td><i>'. $donor_malarial .'</i></td>
<th>Platelets</th>
<td><i>'. $donor_platelets .'</i></td>
</tr>

</table>
<table class="table" style="border-spacing: 0 20px;">

<tr><th class="text-left" ><h2>Blood Bag Information</h2></th></tr>

<tr>
<th width="20%">Blood Bag No.</th>
<td width="20%"><i>'. $blood_bag_no .'</i></td>
<th width="25%">Date of Bleeding </th>
<td width="30%"><i>'. $date_of_bleeding .'</i></td>
</tr>

<tr>
<th width="20%">Component </th>
<td width="20%"><i>'. $component .'</i></td>
<th width="25%">Compatibility </th>
<td width="30%"><i>'. $compatibility .'</i></td>
</tr>
</table>  ';
?>