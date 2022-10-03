<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<form method="post" action="<?php echo $baseurl; ?>create_report/<?php echo $id; ?>">
            <div class="row">
 <div class="col-12 col-md-6 col-lg-6">

            <div class="card">
                <div class="card-body">
<input type="hidden" name="pid" value="<?php echo $pid; ?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id; ?>" class="form-control">
<input type="hidden" name="tid" value="<?php echo $tid; ?>" class="form-control">
<?php

    $db_results = mysqli_query($con, "select * from culture_report where bdid='$id' and tid='$tid' ") or die(mysqli_error());
    $count_results = mysqli_num_rows($db_results);

    
    $growth = 'Select Growth';
    $specimen = 'Select Specimen';
    $bacterial_growth = 'Select Bacterial Count / Growth';
    $zn_stain = 'Select Z-N Stain';
    $gram_stain = "Select Grams Stain";
    $microscopy = 'Select Microscopy';
    
    if($count_results > 0) {
        while ($booking = mysqli_fetch_array($db_results)) {
          
            $organ = $booking['organ'];
            $specimen = $booking['specimen'];
            $growth = $booking['growth'];
            $bacterial_growth = $booking['bacterial_growth'];
            $zn_stain = $booking['zn_stain'];
            $gram_stain = $booking['gram_stain'];
            $microscopy = $booking['microscopy'];
        
        }
        
    }

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
<option value="<?php echo $specimen; ?>"> <?php echo $specimen; ?> </option>
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
<option value="<?php echo $growth; ?>"> <?php echo $growth; ?> </option>
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
<option value="<?php echo $microscopy; ?>"> <?php echo $microscopy; ?> </option>

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
<option value="<?php echo $bacterial_growth; ?>" selected><?php echo $bacterial_growth; ?></option>
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
<option value="<?php echo $zn_stain; ?>" selected><?php echo $zn_stain; ?></option>
    
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
<option value="<?php echo $gram_stain; ?>" selected><?php echo $gram_stain; ?></option>
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
<div class="form-group" style="padding: 5%; text-align:left"> <?php echo $remarks; ?>                   </div>

  
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
                              <tr><td colspan = 3 style="text-align:center">Select growth to see relative medicines</td></tr>
                      </tbody>
                      </table>
                  </div>
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
	   
            
    </div>
            
            <div class="form-group"  style="padding: 2%;">
                <input type="submit" name="culture" class="btn btn-block btn-info" value="Save">                   
                <div style="text-align:right; margin-top:2%"><input type="submit" name="publish_culture" value="Conducted Test" class="btn btn-warning">  </div>
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