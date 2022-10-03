<?php
$num=1;
$radiologies=mysqli_query($con,"select * from radiology where testid='$tid' limit 1") or die (mysqli_error());
while($rad=mysqli_fetch_array($radiologies)){
	$exam=$rad['examination'];
	$comp=$rad['complain'];
	$his=$rad['history'];
	$pro=$rad['protocol'];
	$find=$rad['findings'];
	$impr=$rad['impressions'];
	$comment=$rad['clnical_comments'];
	$testid=$rad['testid'];
	
	
}
?>
<form method="post" action="<?php echo $baseurl;?>create_report/<?php echo $id;?>"> 
            <div class="row">
  <input type="hidden" name="pid" value="<?php echo $pid;?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid;?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id;?>" class="form-control">
<input type="hidden" name="tid" value="<?php echo $tid;?>" class="form-control">
          
 <div class="col-12 col-md-12 col-lg-12">
            
                <div class="card">
                 <div class="card-body">
                  <div class="col-md-12">
                  <div class="row">
              		<div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="examination" value="<?php echo $exam;?>" class="form-control" placeholder=" Examination ">                      </div>

                    </div>

                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="complaint" value="<?php echo $comp;?>" class="form-control" placeholder="Patient’s Complain">                      
</div>

                    </div>

                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="history" value="<?php echo $his;?>" class="form-control" placeholder="Patient’s History">                      </div>

                    </div>

                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="protocols" value="<?php echo $pro;?>" class="form-control" placeholder="Protocols">                      </div>

                    </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Findings</label>
<textarea name="findings" class="summernote"><?php echo $find;?></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Impressions</label>
<textarea name="impressions" class="summernote"><?php echo $impr;?></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
<label>Clinical Comment </label>
<textarea name="comments" class="summernote"><?php echo $comment;?></textarea>
	                    </div>
                  
	                </div>

<?php echo $message;?>


	                </div>

                  </div>
                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">

                     <div class="form-group">
<input type="submit" name="radiology" class="btn btn-info btn-block">   
                 </div>
                  </div>
</div>
              </div>
</div>
</form>
