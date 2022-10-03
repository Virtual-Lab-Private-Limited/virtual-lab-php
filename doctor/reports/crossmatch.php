<?php
	$cross_matchs=mysqli_query($con,"select * from  crossmatch_result where bdid='$report_id' limit 1") or die (mysqli_error($con));
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
    
?>

<div id="div_print">
    <style>
        table { border-collapse:collapse; overflow: hidden }
        table td { border:none; width="25%"}
        table th { width="25%"; }
        #heading {width="50%" !important;}
   </style>
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                  <?php include("header.php"); ?>
                </div>
                <div class="row">
                    <div class="table-responsive">
                      <table class="table" >
                      <tr><th  class="text-left" id='heading'><h5>Recipient Information</h5></th></tr>
                        <tr >
<th class="text-left" width="25%">Recipient Name</th> 
<td class="text-left" width="25%"><?php echo $rec_name;?></td>
<th class="text-left" width="25%">Recipient Blood Group</th>
<td class="text-left" width="25%"><?php echo $rec_blood_group;?></td>

</tr>
<tr><th  class="text-left" ><h5>Donor Information</h5></th></tr>
                      
<tr class="table-border-bottom">

<th class="text-left noborder" width="40px">Donor Name</th>
<td class="text-left noborder"><?php echo $donor_name;?></td>

<th class="text-left noborder" width="40px">Donor Blood Group</th>
<td class="text-left noborder"><?php echo $donor_blood_group;?></td>

</tr>
</table>
                      <table class="table">
<tr>

<th class="text-left" ><h5>Donor's Tests</h5></th>

</tr>
<tr>
<th>HBsAg</th>

<td><?php  if(((float)$donor_hbsag)<1){ echo 'Non-Reactive'; } else{ echo 'Reactive';}?></td>
<th>Donor Value</th>
<td><?php echo $donor_hbsag;?></td>
<th>Cutt off Value</th>
<td>1</td>
</tr>

<tr>
<th>Anti HCV</th>
<td><?php  if(((float)$donor_anti_hcv)<1){ echo 'Non-Reactive'; } else{ echo 'Reactive';}?></td>
<th>Donor Value</th>
<td><?php echo $donor_anti_hcv;?></td>
<th>Cutt off Value</th>
<td>1</td>
</tr>
<tr>
<th>Anti HIV</th>
<td><?php  if(((float)$donor_anti_hiv)<1){ echo 'Non-Reactive'; } else{ echo 'Reactive';}?></td>
<th>Donor Value</th>
<td><?php echo $donor_anti_hiv;?></td>
<th>Cutt off Value</th>
<td>1</td>
</tr>
<tr>
<th>V.D.R.L</th>
<td><?php echo $donor_vdrl;?></td>
<!-- <td><?php  if($donor_vdrl<1){ echo 'Negative'; } else{ echo 'Positive';}?></td>
<td>Cutt off Value</td>
<td>1</td> -->
</tr>
<tr>
<th>Malarial Parasite</th>
<td><?php echo $donor_malarial;?></td>
<!-- <td><?php  if($donor_malarial<1){ echo 'Negative'; } else{ echo 'Positive';}?></td>
<td>Cutt off Value</td>
<td>1</td> -->
</tr>
<tr>
<th>Hemoglobin</th>
<td><?php echo $donor_hemoglobin;?></td>

</tr>
<tr>
<th>Platelets</th>
<td><?php echo $donor_platelets;?></td>

</tr>


</table>
<table class="table" style="overflow: hidden;">
<th class="text-left" ><h5>Blood Bag Information</h5></th>

<tr>
<th>Blood Bag No.</th>
<td><?php echo $blood_bag_no;?></td>

<th>Date of Bleeding </th>
<td><?php echo $date_of_bleeding;?></td>

</tr>
<tr>
<th>Component </th>
<td><?php echo $component;?></td>

<th>Compatibility </th>
<td><?php echo $compatibility;?></td>

</tr>
</table>
                   </div>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
        </div>
                       <?php include("footer.php"); ?>
                    <hr>
              </div>
              
</div>                
