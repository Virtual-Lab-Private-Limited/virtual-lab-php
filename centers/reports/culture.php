
<?php

$cultures=mysqli_query($con,"select * from culture_report where bdid='$report_id' limit 1") or die (mysqli_error());
while($cul=mysqli_fetch_array($cultures)){
	$specimen=$cul['specimen'];
	$growth=$cul['growth'];
	$microscopy=$cul['microscopy'];
	$bacterial_growth=$cul['bacterial_growth'];
	$zn_stain=$cul['zn_stain'];
	$gram_stain=$cul['gram_stain'];
}
?>

<div id="div_print">
    
<style>
    table { border-collapse:collapse; overflow: hidden }
    table td { border:none;}
</style>
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                  <?php include("header.php"); ?>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
<th width="15%">Particulars</th>
<th class="text-center" >Value</th>
                        </tr>
<tr>
<td width="15%"><h6>Specimen</h6></td>
<td class="text-center" >
<?php echo $specimen;?>
</td>
</tr>
<tr>
<td width="15%"><h6>Growth</h6></td>
<td class="text-center" >
<?php echo $growth;?>
</td>
</tr>
<tr>
<td width="15%"><h6>Microscopy</h6></td>
<td class="text-center" >
<?php echo $microscopy;?>
</td>
                        </tr>
<tr>
<td width="15%"><h6>Bacterial Count / Growth</h6></td>
<td class="text-center" >
<?php echo $bacterial_growth;?>
</td>
                        </tr>
<tr>
<td width="15%"><h6>Z-N Stain</h6></td>
<td class="text-center" >
<?php echo $zn_stain;?>
</td>
                        </tr>
<tr>
<td width="15%"><h6>Gram's Stain</h6></td>
<td class="text-center" >
<?php echo $gram_stain;?>
</td>
                        </tr>

                      </table>
                   </div>
                    <div class="row mt-4">
<div class="col-lg-12 col-md-12 col-sm-12"><p align="center">
<strong><h5>ANTIMICROBIAL SENSITIVITY</h5></strong></p>
                      </div>
                      <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">

                      <?php
                    
                      $medicines=mysqli_query($con,"select * from  medicine_details where bid='$bid'") or die (mysqli_error());
                      while($row=mysqli_fetch_array($medicines)){
                     
                      ?>
                        <tr>
<td width="15%"><?php echo $row['med'] ?></td>
<td class="text-center" ><?php echo $row['c_result'] ?></td>
                        </tr>
                      <?php } ?>

                      </table>
                      </div>  
                      <strong><h6> S = Sensitive, R = Resistant, I = Intermediate </h6> </strong>
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
        </div>
                      <?php include("footer.php"); ?>
                      <hr>
              </div>
              
</div>                
