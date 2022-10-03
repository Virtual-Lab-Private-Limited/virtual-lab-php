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
<td class="text-center" width="25%"><b>'.$rec_name.'</b></td>
<th class="text-left" width="35%" >Recipient Blood Group</th>
<td class="text-center" width="25%"><b>'. $rec_blood_group .'</b></td>
</tr>
<br>
<tr><th colspan="5" class="text-left" ><h2>Donor Information</h2></th></tr>
<br>            
<tr >
<th class="text-left" width="25%">Donor Name</th> 
<td class="text-center" width="25%"><b>'.$donor_name.'</b></td>
<th class="text-left" width="35%">Donor Blood Group</th>
<td class="text-center" width="25%"><b>'. $donor_blood_group .'</b></td>
</tr>
</table>
<table  style="border-spacing: 0 20px;">

<tr><th class="text-left"><h2>Donor\'s Tests</h2></th></tr>

<tr>
<th width="20%">HBsAg</th>
<td width="15%"><b>'. $donor_hbsag .'</b></td>
<th width="20%">Anti HCV</th>
<td width="15%"><b>'. $donor_anti_hcv .'</b></td>
</tr>

<tr>
<th width="20%">Anti HIV</th>
<td width="15%"><b>'. $donor_anti_hiv .'</b></td>
<th>V.D.R.L</th>
<td><b>'. $donor_vdrl .'</b></td>
</tr>
<tr>
<th>Hemoglobin</th>
<td><b>'. $donor_hemoglobin .'</b></td>
</tr>
<tr>
<th>Malarial Parasite</th>
<td><b>'. $donor_malarial .'</b></td>
</tr><tr>
<th>Platelets</th>
<td><b>'. $donor_platelets .'</b></td>
</tr>

</table>
<table class="table" style="border-spacing: 0 20px;">

<tr><th class="text-left" ><h2>Blood Bag Information</h2></th></tr>

<tr>
<th width="20%">Blood Bag No.</th>
<td width="20%"><b>'. $blood_bag_no .'</b></td>
<th width="25%">Date of Bleeding </th>
<td width="30%"><b>'. $date_of_bleeding .'</b></td>
</tr>

<tr>
<th width="20%">Component </th>
<td width="20%"><b>'. $component .'</b></td>
<th width="25%">Compatibility </th>
<td width="30%"><b>'. $compatibility .'</b></td>
</tr>
</table>  ';
?>