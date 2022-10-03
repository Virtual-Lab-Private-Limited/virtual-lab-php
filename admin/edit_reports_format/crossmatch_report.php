<form method="post" action="<?php echo $baseurl; ?>edit_report.php?id=<?php echo $id; ?>"> 
            <div class="row">
  <input type="hidden" name="pid" value="<?php echo $pid;?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid;?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id;?>" class="form-control">
<input type="hidden" name="tid" value="<?php echo $tid;?>" class="form-control">

<?php
             
$a = 1;
$bookings = mysqli_query($con, "select * from crossmatch_result where bdid='$id'") or die(mysqli_error());
while ($booking = mysqli_fetch_array($bookings)) {
    
    $id = $booking['id'];
?>
 <div class="col-12 col-md-12 col-lg-12">            
                <div class="card">
                 <div class="card-body">
                  <div class="col-md-12">
                  <label><h4>Recipient information: </h4></label>
                  <div class="row">

              		<div class="col-lg-6 col-md-6 col-sm-12">
                        
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="rec_name" value="<?php echo $booking['rec_name'];?>" class="form-control" >               
                       </div>
                    </div>

                   </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
                    <input type="text" name="rec_blood_group" value="<?php echo $booking['rec_blood_group'];?>" class="form-control" required>                      </div>

                    </div>
                    
                    </div>   
</div>
<label><h4>Donor information: </h4></label> 
                    <div class="row">
                
              		<div class="col-lg-6 col-md-6 col-sm-12">
                       <div class="form-group">
                      <div class="input-group">
<input type="text" name="donor_name" value="<?php echo $booking['donor_name'];?>" class="form-control"  required>                      </div>

                    </div>
                    
                     <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_hbsag" list="hbsag" autocomplete="off" value="<?php echo $booking['donor_hbsag'];?>" class="form-control"  required>                      </div>
                      <datalist id="hbsag" >
                          <option value="Reactive">
                          <option value="Non Reactive">                     
                      </datalist>
                    </div>
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_anti_hcv" list="hcv" autocomplete="off" value="<?php echo $booking['donor_anti_hcv'];?>" class="form-control"  required>                      </div>
                      <datalist id="hcv" >
                          <option value="Reactive">
                          <option value="Non Reactive">                     
                      </datalist>
                    </div>
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_anti_hiv" list="hiv" autocomplete="off" value="<?php echo $booking['donor_anti_hiv'];?>" class="form-control"  required>                      </div>
                      <datalist id="hiv" >
                          <option value="Reactive">
                          <option value="Non Reactive">                     
                      </datalist>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                    <input type="text" name="donor_vdrl" class="form-control" list="vdrl" autocomplete="off" value="<?php echo $booking['donor_vdrl'];?>" required>                      
                    <datalist id="vdrl" >
                          <option value="Positive">
                          <option value="Negative">                     
                      </datalist></div>
                    </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <div class="input-group">
<input type="text" name="donor_blood_group" value="<?php echo $booking['donor_blood_group'];?>" class="form-control"  required>                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_malarial" list="malarial" value="<?php echo $booking['donor_malarial'];?>" autocomplete="off" class="form-control" required >                      </div>
                      <datalist id="malarial" >
                          <option value="Positive">
                          <option value="Negative">                      
                      </datalist>
                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="number" name="donor_hemoglobin" value="<?php echo $booking['donor_hemoglobin'];?>" class="form-control"  required>                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="number" name="donor_platelets" value="<?php echo $booking['donor_platelets'];?>" class="form-control"  required>                      </div>

                    </div>
                    </div>

<?php echo $message;?>


	                </div>

                  </div>
                </div>
</div>
              </div>
<div class="col-12 col-md-12 col-lg-12">
            
                <div class="card">
                 <div class="card-body">
                  <div class="col-md-12">
                  <div class="row">

              		<div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
<input type="number" name="blood_bag_no" value="<?php echo $booking['blood_bag_no'];?>" class="form-control"  required>                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="date_of_bleeding" value="<?php echo $booking['date_of_bleeding'];?>" class="form-control"  required>                      </div>

                    </div>

                    </div>
              		<div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
             
                      <input type="text" name="component" list="com-dropdown" value="<?php echo $booking['component'];?>" class="form-control" autocomplete="off"  required>
                     <datalist id="com-dropdown" >
                          <option value="Plasma">
                          <option value="Blood">
                          <option value="Platelets">
                          <option value="Serum">
                      </datalist>
                      </div>
                    
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="compatibility" list="cmp-dropdown" value="<?php echo $booking['compatibility'];?>" autocomplete="off" class="form-control"  required>                      </div>
                      <datalist id="cmp-dropdown" >
                          <option value="Components are compatible">
                          <option value="Components are not compatible">
                          <option value="Blood group is compatible but antibodies are not compatible">
                      </datalist>
                    </div>
                      
                    <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control">
	                </div>
                <?php } ?>  <div class="form-group" style="padding: 5%; text-align:left"> <?php echo $remarks; ?>                   </div>
  
                  <input type="submit" name="cross_match" value=" Update Report " class="btn btn-success btn-block">                      </div>



                  </div>
                </div>
</div>
              </div>

</div>
         <div class="row" style="padding: 5%;">
                <div class="col-lg-12 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Remarks</label>
                            <textarea name="remarks" class="summernote"><?php echo $report_remarks; ?></textarea>
	                    </div>
	            </div>
	       </div>
</form>
