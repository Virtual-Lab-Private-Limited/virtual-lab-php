<div id="div_print">
    <style>
        table { border-collapse:collapse; overflow: hidden; border:none; }
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
                      
                      

<?php 
$results = mysqli_query($con, "select * from  bloodgroup_result where bdid='$report_id' '") or die(mysqli_error());
$count_sub=mysqli_num_rows($results);

?>

<?php if ($count_sub > 1) { ?>
<h4 style="font-size:16px;"><?php echo $title; ?></h4>
<?php } ?>

<table class="table table-md">
<tr>
<th width="47%">Test</th>
<th class="text-left" width="15%">Blood Group</th>

<th class="text-center" width="10%">Rh Factor</th>
                        </tr>

<?php
while($row=mysqli_fetch_array($results)){

?>
<tr>
        <td><?php echo $title;?></td>
        <td class="text-center"><?php echo $row['result'];?></td>
        <td class="text-center"><?php echo $row['rh_factor'];?></td>
</tr>
<?php } ?>

                      </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
        </div>
                    <?php include("footer.php"); ?>
                <hr>
              </div>
              
</div> 