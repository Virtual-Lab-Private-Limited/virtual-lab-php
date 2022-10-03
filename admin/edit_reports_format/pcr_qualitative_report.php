
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
                        <th width="70%">Test</th>
                    
                        <th class="text-center">Results</th>
                        </tr>
                  <?php
                 
                  
$a = 1;
$bookings = mysqli_query($con, "select * from pcr_qualitative_result where bid='$bid'") or die(mysqli_error());
while ($booking = mysqli_fetch_array($bookings)) {

    $tid = $booking['testid'];
    $result = $booking['result'];
    $id = $booking['id'];
    $priority = $booking['priority'];
    $level2 = mysqli_query($con, "select * from tests where id='$tid'") or die(mysqli_error());

    while ($ref = mysqli_fetch_array($level2)) {
        $title = $ref['title'];
        $testid = $ref['id'];
        $remarks = $ref['remarks'];
    }
        ?>
                        <tr>
                     <td width="10%"><input type="number" value="<?php echo $priority; ?>" class="form-control" name="priority[]" ></td>

                        <td><?php echo $title; ?></td>
                        <td><input type="text" name="result[]" value="<?php echo $result; ?>" list="result" autocomplete="off" class="form-control">
                                              
                        <datalist id="result" >
                            <option value="Detected">
                            <option value="Non Detected">                     
                        </datalist>
                        </td>
               
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
<input type="submit" name="pcr_qualitative" class="btn btn-block btn-info" value="Update">                    </div>
                  </div>
              </div>
</div>
</form>