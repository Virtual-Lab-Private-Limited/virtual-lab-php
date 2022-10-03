<?php
	$radiologies=mysqli_query($con,"select * from  radiology_result where bdid='$id' limit 1") or die (mysqli_error());
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
<div id="div_print">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                    	<div class="col-md-9">
                    		<div class="invoice-title">
		                      <div class="login-invoice login-invoice-color">
		            			<img alt="image" src="<?php echo $baseurl.$basepath;?>" height="120" /></div>
		            			</div>
                    	</div>
                    	<div class="col-md-3 align-right">

<li align="left"><strong>Address: </strong><?php echo $baseaddress;?></li>
<li align="left"><strong>Ph: <?php echo $basephone;?></strong></li>
<li align="left"><strong>PHC Registration No: <?php echo $phc;?></strong></li>
                    	</div>

                    </div>
                    <hr>
                    <div class="row">

                      <table class="table table-hover table-md">
                        <tr class="table-border-top">
<th width="12%">Patient Name</th>
<td class="text-left noborder"><?php echo $firstname.' '.$lastname;?></td>
<th class="text-left" width="15%">Username</td>
<td class="text-left noborder"><?php echo $cnic;?></td>
<th class="text-left" width="15%">Sampled</th>
<td class="text-left noborder"><?php echo $test_date;?></td>



                        </tr>
                        <tr>
<th width="12%">Age/Sex</th>
<td class="text-left noborder"><?php echo $age.' / '.$gender;?></td>
<th class="text-left" width="15%">Password</th>
<td class="text-left noborder"><?php echo $pass;?></td>
<th class="text-left" width="15%">Result Reported</th>
<td class="text-left noborder"><?php echo $result_date;?></td>

                        </tr>
                        <tr>
<th width="12%">Contact #</th>
<td class="text-left noborder"><?php echo $contact;?></td>
<th class="text-left" width="15%">For Online Report</th>
<td class="text-left noborder">Virtual Lab Patient APP</td>
<th class="text-left" width="15%">Sample Brought to</th>
<td class="text-left noborder"><?php
if($sample_collect=='rider'){
echo 'Virtual Lab';	
}else{
echo	$sample_collect	;
	
}


?></td>

                        </tr>
                        <tr class="table-border-bottom">
<th width="12%">Blood Group</th>
<td class="text-left noborder"><?php echo $blood_group;?></td>
<th class="text-left" width="15%">Patient ID</th>
<td class="text-left noborder"><?php echo $pid; ?></td>
<th class="text-left" width="15%">Refered By</th>
<td class="text-left noborder"><?php echo $docfirstname.' '.$doclastname;?></td>

                        </tr>

                      </table>

                      <div class="col-md-12">

<h3 style="text-align:center;"><?php echo $cat_title;?></h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table">
<tr>
<td width="15%">Examination</td>
<td><?php echo $exam;?></td>
</tr>
<tr>
<td width="15%">Patient’s Complain</td>
<td><?php echo $comp;?></td>
</tr>
<tr>
<td width="15%">Patient’s History</td>
<td><?php echo $his;?></td>
</tr>
<tr>
<td width="15%">Protocol </td>
<td><?php echo $pro;?></td>
</tr>
<tr>
<td colspan="2" align="center">Findings </td>
</tr>
<tr>
<td colspan="2"><?php echo $find;?></td>
</tr>
<tr>
<td colspan="2" align="center">Impressions </td>
</tr>
<tr>
<td colspan="2"><?php echo $impr;?></td>
</tr><tr>
<td colspan="2" align="center">Clinical Comment  </td>
</tr>
<tr>
<td colspan="2" align="center"><?php echo $comment;?></td>
</tr>
                      </table>
                   </div>
                    <div class="row mt-4">
<div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
                      </div>

<div class="col-lg-12 col-md-12 col-sm-12"><p>This is an electronically verified report and requires no signatures unless manually edites.</p>
                      </div>
<?php
$counsultants=mysqli_query($con,"select * from  frenchise_doctor where labid='$session_labid'") or die (mysqli_error());
while($row=mysqli_fetch_array($counsultants)){

?> 
                     <div class="col-md-3">
                      	<div class="card">
		                  <div class="card-header">
<span style="font-weight:bold;"><?php echo $row['firstname'].' '.$row['lastname'];?></span>
		                  </div>
<div class="card-body">
<div class="invoice-detail-item">
<div class="invoice-detail-name">
<strong><?php echo $row['designation'];?></strong>
<br>
<strong><?php echo $row['education'];?></strong><br>
<strong><?php echo $row['department'];?></strong>
</div>
                        </div>

		                  </div>
		                </div>
                      </div>
<?php
}
?>                    </div>
                  </div>
                </div><hr>
              </div>
              
</div>                
