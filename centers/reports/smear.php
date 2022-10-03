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

                      
<?php 

$results = mysqli_query($con, "select * from  smear_result where bdid='$report_id'") or die(mysqli_error());
      
while($booking=mysqli_fetch_array($results)){       
    $specimen = $booking['specimen'];
    $clinical_details = $booking['clinical_details'];
    $examination = $booking['examination'];
    $conclusion = $booking['conclusion'];
    $interpretation = $booking['interpretation'];
    $notes = $booking['notes'];

}

?>


<div class="form-group">
    <label>Clinical Details:</label>
    <?php echo $clinical_details;?>
</div>
<div class="form-group">
        <label>Specimen Source:</label>
        <?php echo $specimen;?>
</div>
<div class="form-group">
        <label>Microscopic Examination:</label>
        <?php echo $examination;?>
</div>

<div class="form-group">
        <label>Microscopic Interpretation:</label>
        <?php echo $interpretation;?>
</div>
<div class="form-group">
        <label>Conclusion:</label>
        <?php echo $conclusion;?>
</div>
<div class="form-group">
        <label>Clinical Notes:</label>
        <?php echo $notes;?>
</div>


       <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
        </div>
       
    <?php include("footer.php"); ?>
<hr>
</div>
              
</div> 