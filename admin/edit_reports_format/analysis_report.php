
<form method="post" action="<?php echo $baseurl; ?>edit_report.php?id=<?php echo $id; ?>">
<div class="row">

 <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                 <div class="card-body">
<input type="hidden" name="pid" value="<?php echo $pid; ?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id; ?>" class="form-control">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                    <tr>
                        <th>#</th>
                        <th >Test</th>
                        <th class="text-center" colspan="2">Results</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th class="text-center">Left</th>
                        <th class="text-center">Right</th>
                    </tr>

<?php
$a = 1;

$bookings = mysqli_query($con, "select * from analysis_result where bdid='$id' order by priority asc ") or die(mysqli_error());
while ($booking = mysqli_fetch_array($bookings)) {

    $tid = $booking['testid'];
    $left = $booking['left_result'];
    $right = $booking['right_result'];
    $id = $booking['id'];
    $priority = $booking['priority'];
    $level2 = mysqli_query($con, "select * from tests where id='$tid'") or die(mysqli_error());

    while ($ref = mysqli_fetch_array($level2)) {
        $title = $ref['title'];
        $testid = $ref['id'];
    }
    
}
    ?>
<tr>
<td width="10%"><input type="number" value="<?php echo $priority; ?>" class="form-control" name="priority[]" ></td>
<td><?php echo $title; ?><input type="hidden" name="id[]" value="<?php echo $id; ?>" class="form-control"></td>
<td class="text-center"><input type="number" name="left[]" value="<?php echo $left; ?>" class="form-control" placeholder=" Enter Result "></td>
<td class="text-center"><input type="number" name="right[]" value="<?php echo $right; ?>" class="form-control" placeholder=" Enter Result "></td>
</tr>

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
<input type="submit" name="analysis" class="btn btn-block btn-info">                    </div>
                  </div>
              </div>
              </div>
</div>
</form>