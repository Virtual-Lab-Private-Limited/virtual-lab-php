
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
                        <th>Test</th>                        
                        <th class="text-center" width="25%">Blood group</th>
                        <th class="text-center" width="25%">Rh factor</th>
                        </tr>
               
                       <tr>
                        <td><?php echo $test_title; ?></td>
                        <td>
                        <input type="text" name="blood_group" list="dropdown" class="form-control">
                        <datalist id="dropdown" >
                        <option value="A">                       
                        <option value="B">
                        <option value="O">
                        <option value="AB">

                        </datalist>
                 
                        </td>
                
                        <td>
                        <select name="rh_factor" class="form-control">
                            <option value='positive'>Positive</option>
                            <option value='negative'>Negative</option>
                        </select>
                       </td>
                        <input type="hidden" name="tid" value="<?php echo $tid; ?>" class="form-control">

                        </tr>

                         
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
            <input type="submit" name="bloodgroup" class="btn btn-block btn-info" value="Save">                   
            <div style="text-align:right; margin-top:2%"><input type="submit" name="publish_bloodgroup" value="Conducted Test" class="btn btn-warning">  </div>

      </div>
  
      </div>
  </div>
</div>
</form>