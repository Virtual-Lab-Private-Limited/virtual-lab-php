
<form method="post" action="<?php echo $baseurl; ?>edit_report.php?id=<?php echo $id; ?>">
            <div class="row">
<input type="hidden" name="pid" value="<?php echo $pid; ?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id; ?>" class="form-control">

 <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                 <div class="card-body">
                 <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                            <th width="3%">#</th>
                        <th>Test</th>
                        <th class="text-center" width="10%">Patient Value</th>
                        <th class="text-center" width="25%">Results</th>
                        </tr>
                  <?php
                 
                  
$a = 1;
$bookings = mysqli_query($con, "select * from eliza_result where bid='$bid'") or die(mysqli_error());
while ($booking = mysqli_fetch_array($bookings)) {

    $tid = $booking['testid'];
    $value = $booking['patient_value'];
    $result = $booking['result'];
    $priority = $booking['priority'];
    $id = $booking['id'];
    
    $level2 = mysqli_query($con, "select * from tests where id='$tid'") or die(mysqli_error());

    while ($ref = mysqli_fetch_array($level2)) {
        $title = $ref['title'];
        $testid = $ref['id'];
    }
        ?>
                        <tr>
                        <td width="10%"><input type="number" value="<?php echo $priority; ?>" class="form-control" name="priority[]" ></td>
                        <td><?php echo $title; ?></td>
                        <td><input type="text" name="patient_value[]" value="<?php echo $value; ?>" class="form-control"></td>
                        <td><input type="text" name="result[]" list="result" value="<?php echo $result; ?>" autocomplete="off" class="form-control"></td>
                                              
                          <datalist id="result" >
                              <option value="Positive">
                              <option value="Negative">                     
                          </datalist>
                        <input type="hidden" name="id[]" value="<?php echo $id; ?>" class="form-control">

                        </tr>
                        <?php } ?>
                      </table>
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
<div class="form-group" style="padding: 5%; text-align:left"> <?php echo $remarks; ?>                   </div>
  
            <div class="form-group">
<input type="submit" name="eliza" class="btn btn-block btn-info">                    </div>
                  </div>
              </div>
</div>
</form>