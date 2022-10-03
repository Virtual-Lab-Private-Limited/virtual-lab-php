

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
                        <th width="35%">Test</th>
                     
                        <th class="text-center" >Unit</th>
                        <th class="text-center" >Control</th>
                        <th class="text-center">Patient Value</th>
                        </tr>

                        <?php
                          $a = 1;
                            $bookings = mysqli_query($con, "select * from coagulation_result where bid='$bid'") or die(mysqli_error());
                            while ($booking = mysqli_fetch_array($bookings)) {
                        
                            $tid = $booking['testid'];
                            $control = $booking['control'];
                            $value = $booking['value'];
                            
                            $id = $booking['id'];
                              
                             $level2 = mysqli_query($con, "select * from tests where id='$tid'") or die(mysqli_error());

                              while ($ref = mysqli_fetch_array($level2)) {
                                  $title = $ref['title'];
                                  $testid = $ref['id'];
                                  $unit = $ref['unit'];
                                  
                              } 
                                  ?>
                        <tr>
                        <td><?php echo $title; ?></td>
                        <td  width="10%"><?php echo $unit; ?></td>
                        <td><input type="number" name="control[]" value="<?php echo $control; ?>" class="form-control"></td>            
                        <td><input type="number" name="result[]" value="<?php echo $value; ?>" class="form-control"></td>
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
<input type="submit" name="coagulation" class="btn btn-block btn-info" value="Update">                    </div>
                  </div>
              </div>
</div>
</form>