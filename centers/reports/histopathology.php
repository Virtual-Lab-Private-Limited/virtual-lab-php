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
                      
                      
<table class="table table-md" style="overflow: hidden;">
<?php 

$results = mysqli_query($con, "select * from  histopathology_report where bdid='$report_id'") or die(mysqli_error());
      
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

?>
<tr style="text-align:left" >
<td colspan='5' ><h4 ><?php echo $title; ?></h4></td>

</tr>
<tr>
        <td width="25%" class="text-left">Organ</td>
        <td class="text-left"><?php echo $organ;?></td>  
</tr>
<tr>
        <td width="25%" class="text-left">Specimen</td>
        <td class="text-left"><?php echo $specimen;?></td>  
</tr><tr>
        <td width="25%" class="text-left">History Form Attached</td>
        <td class="text-left"><?php echo $history_form;?></td>  
</tr>

</table>
    </div>
<div class="form-group">
    <label>Gross Examination:</label>
    <?php echo $gross;?>
</div>
<div class="form-group">
        <label>Microscopic Examination:</label>
        <?php echo $microscopic;?>
</div>
<div class="form-group">
        <label>Diagnosis:</label>
        <?php echo $diagnosis;?>
</div>

<div class="form-group">
        <label>Pertinent History:</label>
        <?php echo $history;?>
</div>

<div style="text-align:right">
       <strong>Electronic Signature:________________________</strong>

       
</div>

<?php 
       
       $results = mysqli_query($con, "select * from  doctors where id='$doctor'") or die(mysqli_error());
       while($row=mysqli_fetch_array($results)){    ?>
       <div class="row"  >

          <div class="col-md-8"></div>
          <div class="col-md-4" style="border:solid">
          <div><label> <?php echo $row['firstname'].'  '.$row['lastname'];?> </label></div>
          <div><label> <?php echo $row['education'];?> </label></div>
          <div><label> (Histopathology) </label></div>
          
          </div>
        
      </div>  
    <?php }
       ?>
       
       <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
        </div>
       
    <?php include("footer.php"); ?>
<hr>
</div>
              
</div> 