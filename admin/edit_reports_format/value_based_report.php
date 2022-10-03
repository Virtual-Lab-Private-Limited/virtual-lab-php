
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
<th width="3%">#</th>
<th>Test</th>
<th class="text-center" width="15%">Reference Value</th>
<th class="text-center" width="10%">Unit</th>
<th class="text-right" width="25%">Results</th>
                        </tr>

<?php
$a = 1;

$bookings = mysqli_query($con, "select * from value_based_result where bdid='$id' order by priority asc ") or die(mysqli_error());
while ($booking = mysqli_fetch_array($bookings)) {

    $tid = $booking['testid'];
    $value = $booking['value'];
    $id = $booking['id'];
    $priority = $booking['priority'];
    $level2 = mysqli_query($con, "select * from tests where id='$tid'") or die(mysqli_error());

    while ($ref = mysqli_fetch_array($level2)) {
        $title = $ref['title'];
        $testid = $ref['id'];
    }
    ?>
<tr>
<td width="10%"><input type="number" value="<?php echo $priority; ?>" class="form-control" name="priority[]" ></td>
<td><?php echo $title; ?></td>
<td><?php
$rid = 0;
    $references = mysqli_query($con, "select * from test_reference where testid='$testid' and gender='$gender' limit 1") or die(mysqli_error($con));
    $rows = mysqli_num_rows($references);
                      
    if ( $rows > 0)
    {

        while ($ref1 = mysqli_fetch_array($references)) {
            $refrence_value = $ref1['minimum_value'] . ' - ' . $ref1['maximum_value'] ;
            echo $refrence_value;
            $rid = $ref1['id'];
        }

    } else {
       
        $reference = mysqli_query($con, "select * from test_reference where testid='$testid' and additional_data != ''  limit 1") or die(mysqli_error($con));
        while ($ref2 = mysqli_fetch_array($reference)) {
            $refrence_value = $ref2['additional_data']  ;
            echo $refrence_value;
            $rid = $ref2['id'];
        }

    }

    ?></td>
   <?php
$references = mysqli_query($con, "select * from tests where id=$testid ") or die(mysqli_error());
    while ($ref = mysqli_fetch_array($references)) {
        $unit = $ref['unit'];
    }?>
<td><?php echo $unit; ?></td>
<td>
<?php
$dropdowns = mysqli_query($con, "select * from test_dropdowns where refid='$rid'") or die(mysqli_error());
    $count_drop = mysqli_num_rows($dropdowns);
    if ($count_drop > 0) {
        ?>
<input type="text" name="result[]" list="dropdown"  value="<?php echo $value; ?>" class="form-control" autocomplete="off">
<datalist id="dropdown" >

<?php
while ($drop = mysqli_fetch_array($dropdowns)) {
            ?>
<option value="<?php echo $drop['value']; ?>">

<?php
}
        ?>
</datalist>
<input type="hidden" name="id[]" value="<?php echo $id; ?>" class="form-control">


<?php
} else {
        ?>
<input type="text" name="result[]" value="<?php echo $value; ?>" class="form-control" placeholder=" Enter Result ">
<input type="hidden" name="id[]" value="<?php echo $id; ?>" class="form-control">

</td>
</tr>

<?php
}
}
?>



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
<input type="submit" name="value_based" class="btn btn-block btn-info">                    </div>
                  </div>
              </div>
</div>
</form>