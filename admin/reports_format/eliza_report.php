
<form method="post" action="<?php echo $baseurl; ?>create_report/<?php echo $id; ?>">
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
                        <th>#</th>
                        <th>Test</th>

                        <th class="text-center" width="10%">Patient Value</th>
                        <th class="text-center" >Unit</th>
                        <th class="text-center" width="25%">Results</th>
                        </tr>
                  <?php
                  
          
if ($count_sub > 0) {
    $level2 = mysqli_query($con, "select * from tests where pid='$tid'") or die(mysqli_error());
    $a = 0;
    while ($ref = mysqli_fetch_array($level2)) {
        $title = $ref['title'];
        $testid = $ref['id'];
        $unit = $ref['unit'];
   
        $db_results = mysqli_query($con, "select * from eliza_result where bdid='$id' and testid='$testid' ") or die(mysqli_error());
        $count_results = mysqli_num_rows($db_results);
        $value = '';
        $result = '';
        
        if($count_results > 0) {
            while ($res = mysqli_fetch_array($db_results)) {
                $value = $res['patient_value'];
                $result = $res['result'];
                $priority = $res['priority'];
            }
        }
        
        ?>
                        <tr>
                        <td width="10%"><input type="number" value="<?php echo ($priority > 0 ? $priority : $a++); ?>" class="form-control" name="priority[]" ></td>
                   
                        <td><?php echo $title; ?></td>


                        <td><input type="text" name="patient_value[]" class="form-control" value="<?php echo $value; ?>"></td>
                            
                        <td  width="10%"><?php echo $unit; ?></td>

                        <td><input type="text" name="result[]" list="result" value="<?php echo $result; ?>" autocomplete="off" class="form-control"></td>
                                              
                          <datalist id="result" >
                              <option value="Positive">
                              <option value="Negative">                     
                          </datalist>
                        <input type="hidden" name="tid[]" value="<?php echo $testid; ?>" class="form-control">

                        </tr>
                        <?php }} else {
        $db_results = mysqli_query($con, "select * from eliza_result where bdid='$id' and testid='$tid' ") or die(mysqli_error());
        $count_results = mysqli_num_rows($db_results);
        $value = '';
        $result = '';
        $priority = '';
        $a = 0;
        if($count_results > 0) {
            while ($res = mysqli_fetch_array($db_results)) {
                $value = $res['patient_value'];
                $result = $res['result'];
                $priority = $res['priority'];
          
            }
            
        }
    ?>
                       <tr>
                             <td width="10%"><input type="number" value="<?php echo ($priority > 0 ? $priority : $a++); ?>" class="form-control" name="priority[]" ></td>
                   
                        <td><?php echo $test_title; ?></td>


                        <td><input type="text" name="patient_value[]" class="form-control" value="<?php echo $value; ?>"></td>
                            <?php
                        $references = mysqli_query($con, "select * from tests where id=$tid ") or die(mysqli_error());
                            while ($ref = mysqli_fetch_array($references)) {
                                $unit = $ref['unit'];
                            }?>
                        <td  width="10%"><?php echo $unit; ?></td>

                        <td><input type="text" name="result[]" list="result" autocomplete="off" class="form-control" value="<?php echo $result; ?>"></td>
                                              
                        <datalist id="result" >
                              <option value="Positive">
                              <option value="Negative">                     
                        </datalist>
                        <input type="hidden" name="tid[]" value="<?php echo $tid; ?>" class="form-control">

                        </tr>

                          <?php }?>
                      </table>
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
<input type="submit" name="eliza" class="btn btn-block btn-info" value="Save">                   
<div style="text-align:right; margin-top:2%"><input type="submit" name="publish_eliza" value="Conducted Test" class="btn btn-warning">  </div>

                    </div>
                  </div>
              </div>
</div>
</form>