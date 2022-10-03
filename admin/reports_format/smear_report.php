

<form method="post" action="<?php echo $baseurl; ?>create_report/<?php echo $id; ?>">
<div class="row">
<input type="hidden" name="pid" value="<?php echo $pid; ?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id; ?>" class="form-control">
<input type="hidden" name="tid" value="<?php echo $tid; ?>" class="form-control">

<?php


$db_results = mysqli_query($con, "select * from smear_result where bdid='$id' and testid='$tid' ") or die(mysqli_error());
        $count_results = mysqli_num_rows($db_results);
        
        $specimen = '';
        $clinical_details = '';
        $examination = '';
        $conclusion = '';
        $interpretation = '';
        $notes = '';
       
        
        if($count_results > 0) {
            while ($booking = mysqli_fetch_array($db_results)) {
              
                $specimen = $booking['specimen'];
                $clinical_details = $booking['clinical_details'];
                $examination = $booking['examination'];
                $conclusion = $booking['conclusion'];
                $interpretation = $booking['interpretation'];
                $notes = $booking['notes'];
            }
            
        }
    
?>


 <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                 <div class="card-body">
                 <div class="col-md-12">
                
                    <div class="form-group">
	                      <label>Clinical Details</label>
                          <textarea name="details" class="summernote"><?php echo $clinical_details;?></textarea>
	                </div>
                    <div class="form-group">
	                      <label>Specimen Source</label>
                          <textarea name="specimen" class="summernote"> <?php echo $specimen;?> </textarea>
	                </div>
                    <div class="form-group">
	                      <label>Microscopic Examination</label>
                          <textarea name="examination" class="summernote"> <?php echo $examination;?> </textarea>
	                </div>
                    <div class="form-group">
	                      <label>Microscopic Interpretation</label>
                          <textarea name="interpretation" class="summernote"> <?php echo $interpretation;?> </textarea>
	                </div>
	                <div class="form-group">
	                      <label>Conclusion</label>
                          <textarea name="conclusion" class="summernote"> <?php echo $conclusion;?> </textarea>
	                </div>
                    <div class="form-group">
	                      <label>Clinical Notes</label>
                          <textarea name="notes" class="summernote"> <?php echo $notes;?> </textarea>
	                </div>

       
                  </div>
                </div>
            <div class="row" style="padding: 5%;">
                <div class="col-lg-12 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Remarks</label>
                            <textarea name="remarks" class="summernote"></textarea>
	                    </div>
	            </div>
	       </div>
<div class="form-group" style="padding: 5%; text-align:left"> <?php echo $remarks; ?>                   </div>
        <div class="form-group"  style="padding: 2%;">
                    <input type="submit" name="smear" class="btn btn-block btn-info" value="Save">                   
                    <div style="text-align:right; margin-top:2%"><input type="submit" name="publish_smear" value="Conducted Test" class="btn btn-warning">  </div>
                </div>   
              </div>
              </div>
</div>
</form>