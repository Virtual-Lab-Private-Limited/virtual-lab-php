<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<form method="post" action="<?php echo $baseurl; ?>edit_report.php?id=<?php echo $id; ?>">
            <div class="row">
 <div class="col-12 col-md-6 col-lg-6">

            <div class="card">
                <div class="card-body">
<input type="hidden" name="pid" value="<?php echo $pid; ?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id; ?>" class="form-control">
<input type="hidden" name="tid" value="<?php echo $tid; ?>" class="form-control">

<?php
            
$bookings = mysqli_query($con, "select * from culture_report where bid='$bid'") or die(mysqli_error());
while ($booking = mysqli_fetch_array($bookings)) {
    
    $id = $booking['id'];
?>

<div class="form-group">
    <div class="input-group">
    <div class="input-group-prepend">
        <div class="input-group-text">
<strong><label>Specimen </label>
</strong>
                          </div>
                        </div>
<select name="specimen" class="form-control" style="width:100%">
<option value="<?php echo $booking['specimen']; ?>"><?php echo $booking['specimen']; ?></option>
<?php
$specimens = mysqli_query($con, "select * from culture_info where cid=1") or die(mysqli_error());
while ($spc = mysqli_fetch_array($specimens)) {
    ?>
<option value="<?php echo $spc['title']; ?>"><?php echo $spc['title']; ?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Growth </label>
</strong>
                          </div>
                        </div>
<select name="growth" id="growth" class="form-control" style="width:100%">
<option value="<?php echo $booking['growth']; ?>" ><?php echo $booking['growth']; ?></option>
<?php
$specimens = mysqli_query($con, "select * from culture_info where cid=2") or die(mysqli_error());
while ($spc = mysqli_fetch_array($specimens)) {
    ?>
<option value="<?php echo $spc['title']; ?>" data-id="<?php echo $spc['id']; ?>"><?php echo $spc['title']; ?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Microscopy </label>
</strong>
                          </div>
                        </div>
<select name="microscopy" class="form-control" style="width:100%">
<option value="<?php echo $booking['microscopy']; ?>" ><?php echo $booking['microscopy']; ?></option>
<?php
$specimens = mysqli_query($con, "select * from culture_info where cid=3") or die(mysqli_error());
while ($spc = mysqli_fetch_array($specimens)) {
    ?>
<option value="<?php echo $spc['title']; ?>"><?php echo $spc['title']; ?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Bacterial Count / Growth
 </label>
</strong>
                          </div>
                        </div>
<select name="bacterial_count" class="form-control" style="width:100%">
<option value="<?php echo $booking['bacterial_growth']; ?>" ><?php echo $booking['bacterial_growth']; ?></option>
<?php
$specimens = mysqli_query($con, "select * from culture_info where cid=4") or die(mysqli_error());
while ($spc = mysqli_fetch_array($specimens)) {
    ?>
<option value="<?php echo $spc['title']; ?>"><?php echo $spc['title']; ?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Z-N Stain
 </label>
</strong>
                          </div>
                        </div>
<select name="zn_stain" class="form-control" style="width:100%">
<option value="<?php echo $booking['zn_stain']; ?>" ><?php echo $booking['zn_stain']; ?>
</option>
<?php
$specimens = mysqli_query($con, "select * from culture_info where cid=5") or die(mysqli_error());
while ($spc = mysqli_fetch_array($specimens)) {
    ?>
<option value="<?php echo $spc['title']; ?>"><?php echo $spc['title']; ?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Gram's Stain
 </label>
</strong>
                          </div>
                        </div>
<select name="gram_stain" class="form-control" style="width:100%">
<option value="<?php echo $booking['gram_stain']; ?>" ><?php echo $booking['gram_stain']; ?>
</option>
<?php
$specimens = mysqli_query($con, "select * from culture_info where cid=6") or die(mysqli_error());
while ($spc = mysqli_fetch_array($specimens)) {
    ?>
<option value="<?php echo $spc['title']; ?>"><?php echo $spc['title']; ?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                  <input type="hidden" name="id" value="<?php echo $id; ?>" >
  
                    
    <?php } ?>  
<div class="form-group" style="padding: 5%; text-align:left"> <?php echo $remarks; ?>                   </div>
  
                     <div class="form-group">
<input type="submit" name="culture" class="btn btn-block btn-info">                    </div>
                  </div>
              </div>
</div>
 <div class="col-12 col-md-6 col-lg-6">

                <div class="card">
                 <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
                          <th width="5%"> ID </th>
                          <th>Medicine</th>
                          <th>Relative Strength</th>

                          </tr>
                        </thead>
                        <tbody id="medicine-box">
                            <?php
            
$medicines = mysqli_query($con, "select * from medicine_details where bid='$bid'") or die(mysqli_error());
$count = 0;
while ($medicine = mysqli_fetch_array($medicines)) {
    
    
   
?>
                              <tr><td align=center><?php echo ++$count; ?></td>
                              <td align=center><input type='text' value='<?php echo $medicine['med']; ?>' class='form-control' name='meds[]' readonly></td>
                              <td align=center>
                                  <select name='intensity[]' class='form-control'>
                                          <option value='<?php echo $medicine['c_result']; ?>'><?php echo $medicine['c_result']; ?></option>
                                      <option value='S'>Sensitive</option>
                                      <option value='R'>Resistent</option>
                                      <option value='I'>Intermediate</option>
                                    </select>  
                                    </td>
                              </tr>
                              <input type="hidden"  name='mid[]' value= '<?php echo $medicine['id']; ?>'>
                        <?php } ?>
                      </tbody>
                      </table>
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

<script>
$(document).ready(function(){

  $("#growth").change(function(e){

    var culture_id = $('option:selected', this).attr('data-id');
    
    console.log("culture id : ",culture_id );

    $.ajax({                                      
      url: 'https://www.virtuallab.com.pk/admin/reports_format/api.php/',                  //the script to call to get data          
      data: {'culture_id': culture_id},                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'html',                //data format      
      success: function(data)          //on recieve of reply
      {

        $('#medicine-box').html(data);
        
      }, 
      error: function(data)          //on recieve of error
      {
        console.log(data);
        
      } 
    });
  });
});
</script>