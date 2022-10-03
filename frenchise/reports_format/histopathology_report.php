

<form method="post" action="<?php echo $baseurl; ?>create_report/<?php echo $id; ?>">
<div class="row">
<input type="hidden" name="pid" value="<?php echo $pid; ?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id; ?>" class="form-control">
<input type="hidden" name="tid" value="<?php echo $tid; ?>" class="form-control">

<?php


$db_results = mysqli_query($con, "select * from histopathology_report where bdid='$id' and testid='$tid' ") or die(mysqli_error());
        $count_results = mysqli_num_rows($db_results);
        
        $organ = '';
        $specimen = '';
        $history_form = '';
        $gross = '';
        $microscopic = '';
        $diagnosis = '';
        $history = '';
        
       
        
        if($count_results > 0) {
            while ($booking = mysqli_fetch_array($db_results)) {
              
                $organ = $booking['organ'];
                $specimen = $booking['specimen'];
                $history_form = $booking['history_form'];
                $gross = $booking['gross'];
                $microscopic = $booking['microscopic'];
                $diagnosis = $booking['diagnosis'];
                $history = $booking['history'];
            
            }
            
        }
    
?>


 <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                 <div class="card-body">
                 <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                           <td>Organ </td>                        
                            <td>
                            <input type="text" name="organ" list="organ_dropdown" class="form-control" value="<?php echo $organ;?>">
                            <datalist id="organ_dropdown" >
                            <option value="Liver">                       
                            <option value="Lungs">
                            <option value="Renal">
                            <option value="Gut">
                            <option value="Heart">
                            </datalist>
                            </td>                        
                        </tr>
                        <tr>
                           <td>Specimen</td>                        
                            <td>
                            <input type="text" name="specimen" list="specimen_dropdown" class="form-control" value="<?php echo $specimen;?>">
                            <datalist id="specimen_dropdown" >
                            <option value="Gall bladder">                       
                            <option value="Uterus">
                            <option value="Breast">
                            <option value="Finger">
                            <option value="Appendix">
                            <option value="Gut">

                            </datalist>
                            </td>                        
                        </tr>
                        <tr>
                           <td>History Form Attached</td>                        
                            <td>
                            <select  name="history_form" class="form-control">
                                <option value="<?php echo $history_form;?>"> <?php echo $history_form;?> </option> 
                                <option value="Yes">Yes</option>                      
                                <option value="No">No</option> 
                            </select>
                            </td>                        
                        </tr>
                      </table>
                    </div>
                    <div class="form-group">
	                      <label>Gross Examination</label>
                          <textarea name="gross" class="summernote"><?php echo $gross;?></textarea>
	                </div>
                    <div class="form-group">
	                      <label>Microscopic Examination</label>
                          <textarea name="microscopic" class="summernote"> <?php echo $microscopic;?> </textarea>
	                </div>
                    <div class="form-group">
	                      <label>Diagnosis</label>
                          <textarea name="diagnosis" class="summernote"> <?php echo $diagnosis;?> </textarea>
	                </div>
              
                    <div class="form-group">
	                      <label>Pertinent History</label>
                          <textarea name="history" class="summernote"> <?php echo $history;?> </textarea>
	                </div>

                     
                    <div class="form-group" >
	                      <label>Select Doctor</label>
                          <select name="doctor" class="form-control">
                          <?php
                            $doctors = mysqli_query($con, "select * from doctors ") or die(mysqli_error());
                            while ($ref = mysqli_fetch_array($doctors)) { ?>
                            <option value="<?php echo $ref['id'] ?>"><?php echo $ref['firstname'].' '.$ref['lastname'].'-'.$ref['education']; ?></option>
                         <?php }?>
                          </select>
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
                    <input type="submit" name="histopathology" class="btn btn-block btn-info" value="Save">                   
                    <div style="text-align:right; margin-top:2%"><input type="submit" name="publish_histopathology" value="Conducted Test" class="btn btn-warning">  </div>
                </div>   
              </div>
              </div>
</div>
</form>