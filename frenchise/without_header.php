<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$booking_details=mysqli_query($con,"select * from booking_details where id='$id' limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($booking_details)){
	$bid=$data['bid'];
	$pid=$data['pid'];
	$tid=$data['tid'];
	$result_date=$data['result_date'];
}
$tests=mysqli_query($con,"select * from tests where id='$tid' limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($tests)){
	$title=$data['title'];
	$type=$data['type'];
	$test_remarks=$data['remarks'];
	$catid=$data['catid'];

}
$bookings=mysqli_query($con,"select * from bookings where id='$bid' limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($bookings)){
	$bookingno=$data['bookingno'];
	$test_date=$data['test_date'];
	$referby=$data['referby'];
	$sample_collect=$data['sample_collect'];
}
$doctors=mysqli_query($con,"select * from doctors where id='$referby' limit 1") or die (mysqli_error());
while($doc=mysqli_fetch_array($doctors)){
$docfirstname=$doc['firstname'];
$doclastname=$doc['lastname'];
$hospital=$doc['clinic'];
}
$patients=mysqli_query($con,"select * from patients where id='$pid' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($patients)){
	$firstname=$info['firstname'];
$lastname=$info['lastname'];
$cnic=$info['cnic'];
$contact=$info['contact'];
$city=$info['city'];
$dob=$info['dob'];
$age=$info['age'];
$blood_group=$info['blood_group'];
$pass=$info['pass'];
$gender=$info['gender'];

}

$categories=mysqli_query($con,"select * from categories where id='$catid' limit 1") or die (mysqli_error($con));
while($cat=mysqli_fetch_array($categories)){
	$cat_title=$cat['category'];	
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Report | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
  <style>
  td{border:1px solid lightgray;
  }
  li{
	  display:block;
  }
  </style>
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
<h1><?php echo $firstname.' '.$lastname;?>'s Test Report</h1>
								</div>
							</div>
						</div>
					</div>

          <div class="section-body">
            <div class="invoice">
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
<?php
if($type=='culture'){
$cultures=mysqli_query($con,"select * from culture_report where tid='$tid' and pid='$pid' and bid='$id' limit 1") or die (mysqli_error());
while($cul=mysqli_fetch_array($cultures)){
	$specimen=$cul['specimen'];
	$growth=$cul['growth'];
	$microscopy=$cul['microscopy'];
	$bacterial_growth=$cul['bacterial_growth'];
	$zn_stain=$cul['zn_stain'];
	$gram_stain=$cul['gram_stain'];
}
?>
<div id="div_print">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
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
                      <table class="table table-striped table-hover table-md">
                        <tr>
<td width="15%">Particulars</td>
<td class="text-center" >Value</td>
                        </tr>
<tr>
<td width="15%">Specimen</td>
<td class="text-center" >
<?php $culture_info=mysqli_query($con,"select * from culture_info where id='$specimen' limit 1") or die (mysqli_error());
while($ci=mysqli_fetch_array($culture_info)){
	echo $ci['title'];
}?>
</td>
</tr>
<tr>
<td width="15%">Growth</td>
<td class="text-center" >
<?php $culture_info=mysqli_query($con,"select * from culture_info where id='$growth' limit 1") or die (mysqli_error());
while($ci=mysqli_fetch_array($culture_info)){
	echo $ci['title'];
}?>
</td>
                        </tr>
<tr>
<td width="15%">Microscopy</td>
<td class="text-center" >
<?php $culture_info=mysqli_query($con,"select * from culture_info where id='$microscopy' limit 1") or die (mysqli_error());
while($ci=mysqli_fetch_array($culture_info)){
	echo $ci['title'];
}?>
</td>
                        </tr>
<tr>
<td width="15%">Bacterial Count / Growth</td>
<td class="text-center" >
<?php $culture_info=mysqli_query($con,"select * from culture_info where id='$bacterial_growth' limit 1") or die (mysqli_error());
while($ci=mysqli_fetch_array($culture_info)){
	echo $ci['title'];
}?>
</td>
                        </tr>
<tr>
<td width="15%">Z-N Stain</td>
<td class="text-center" >
<?php $culture_info=mysqli_query($con,"select * from culture_info where id='$zn_stain' limit 1") or die (mysqli_error());
while($ci=mysqli_fetch_array($culture_info)){
	echo $ci['title'];
}?>
</td>
                        </tr>
<tr>
<td width="15%">Gram's Stain</td>
<td class="text-center" >
<?php $culture_info=mysqli_query($con,"select * from culture_info where id='$gram_stain' limit 1") or die (mysqli_error());
while($ci=mysqli_fetch_array($culture_info)){
	echo $ci['title'];
}?>
</td>
                        </tr>

                      </table>
                   </div>
                    <div class="row mt-4">
<div class="col-lg-12 col-md-12 col-sm-12"><p align="center">
<strong>ANTIBIOTIC SENSITIVITY</strong></p>
                      </div>
                      <div class="col-md-3">
                      	<div class="card">
		                  <div class="card-header">
<strong>High</strong>
		                  </div>
<div class="card-body">
<?php
$medicines=mysqli_query($con,"select * from medicine_details where bid='$id' and c_result='High'") or die (mysqli_error());
while($med=mysqli_fetch_array($medicines)){

?>
<li><strong><?php
$medicineid=$med['mid'];
$meds=mysqli_query($con,"select * from medicines where id='$medicineid' limit 1") or die (mysqli_error());
while($m=mysqli_fetch_array($meds)){
	echo $m['title'];
}
?></strong></li>
<?php
}
?>
		                  </div>
		                </div>
                      </div>
                      <div class="col-md-3">
                      	<div class="card">
		                  <div class="card-header">
<strong>Low:</strong>
		                  </div>
<div class="card-body">
<?php
$medicines=mysqli_query($con,"select * from medicine_details where bid='$id' and c_result='Low'") or die (mysqli_error());
while($med=mysqli_fetch_array($medicines)){

?>
<li><strong><?php
$medicineid=$med['mid'];
$meds=mysqli_query($con,"select * from medicines where id='$medicineid' limit 1") or die (mysqli_error());
while($m=mysqli_fetch_array($meds)){
	echo $m['title'];
}
?></strong></li>
<?php
}
?>

		                  </div>
		                </div>
                      </div>
                      <div class="col-md-3">
                      	<div class="card">
		                  <div class="card-header">
<strong>Weak</strong>
		                  </div>
<div class="card-body">
<?php
$medicines=mysqli_query($con,"select * from medicine_details where bid='$id' and c_result='Weak'") or die (mysqli_error());
while($med=mysqli_fetch_array($medicines)){

?>
<li><strong><?php
$medicineid=$med['mid'];
$meds=mysqli_query($con,"select * from medicines where id='$medicineid' limit 1") or die (mysqli_error());
while($m=mysqli_fetch_array($meds)){
	echo $m['title'];
}
?></strong></li>
<?php
}
?>

		                  </div>
		                </div>
                      </div>
                      <div class="col-md-3">
                      	<div class="card">
		                  <div class="card-header">
<strong>Resistance</strong>
		                  </div>
<div class="card-body">
<?php
$medicines=mysqli_query($con,"select * from medicine_details where bid='$id' and c_result='Res'") or die (mysqli_error());
while($med=mysqli_fetch_array($medicines)){

?>
<li><strong><?php
$medicineid=$med['mid'];
$meds=mysqli_query($con,"select * from medicines where id='$medicineid' limit 1") or die (mysqli_error());
while($m=mysqli_fetch_array($meds)){
	echo $m['title'];
}
?></strong></li>
<?php
}
?>

		                  </div>
		                </div>
                      </div>
<div class="col-lg-12 col-md-12 col-sm-12"><p align="center">
<strong>ANTIBIOTIC SENSITIVITY</strong></p>
                      </div>
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

<?php
}
else if($type=='radiology'){
?>
<div id="div_print">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
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
                      <table class="table table-striped table-hover table-md">
                        <tr>
<td width="15%">Particulars</td>
<td class="text-center" >Results </td>
                        </tr>
<?php
$perams=mysqli_query($con,"select * from test_perameters where tid='$tid'") or die (mysqli_error());
while($perm=mysqli_fetch_array($perams)){
	$perameterid=$perm['id'];
?>
<tr>
<td width="15%"><?php echo $perm['title'];?></td>
<td class="text-center" >
<?php $radio_info=mysqli_query($con,"select * from patient_test_details where tid='$tid' and peraid='$perameterid' limit 1") or die (mysqli_error($con));
while($ri=mysqli_fetch_array($radio_info)){
	echo $ri['tp_result'];
}?>
</td>
</tr>

<?php
}
?>
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

<?php
}

else{
	?>
<div id="div_print">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
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
                      <table class="table table-striped table-hover table-md">
<tr>
<td colspan="5"><h4 style="font-size:16px; text-align:center;"><?php echo $title;?></h4>
</td>
</tr>
                        <tr>
                          <th width="3%">#</th>
<th width="47%">Test</th>
<th class="text-center" width="15%">Normal Value</th>
<th class="text-center" width="5%">Unit</th>
<th class="text-right" width="10%">Results</th>
                        </tr>

<?php
$a=1;
$test_details=mysqli_query($con,"select * from patient_test_details where tid='$tid'") or die (mysqli_error());
while($tdata=mysqli_fetch_array($test_details)){
	
	$peraid=$tdata['peraid'];

if($peraid>0){
$perameters=mysqli_query($con,"select * from test_perameters where id='$peraid' limit 1") or die (mysqli_error());
while($per=mysqli_fetch_array($perameters)){
	$title=$per['title'];
	$remarks=$per['remarks'];

$frenchise_perameters=mysqli_query($con,"select * from frenchise_perameters where pid='$peraid' and  labid='$session_labid'") or die (mysqli_error($con));
while($fp=mysqli_fetch_array($frenchise_perameters)){
	$normal_value= $fp['referencevalues'];
	$unit=$fp['units'];

}	
}
	
}
else{
	$title=$peraid;
	$normal_value='';
	$unit='';
	$remarks='';	
}

?>
                        <tr>
<td><?php echo $a++;?></td>
<td><?php echo $title;?></td>
<td><?php echo $normal_value;?></td>
<td class="text-center"><?php echo $qty=$unit;?></td>
<td class="text-center"><?php echo $tdata['tp_result'];?></td>
                        </tr>
<?php
if($remarks>0){
?>
<tr>
<td width="10%">Remarks</td>
<td class="text-right" colspan="4"><?php echo $remarks;?></td>
<?php
}else{
	
}
}

?>

                      </table>
                    </div>
                    <div class="row mt-4">
                    <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
                      </div>

<div class="col-lg-12 col-md-12 col-sm-12">
<p align="center" style="border-bottom:2px solid black;">This is an electronically verified report and requires no signatures unless manually edites.</p>
                      </div>

<br>                      
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
?>
                    </div>
<div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>

                  </div>
                </div><hr>
              </div>
              
</div>                
<?php
}
?>
<div class="row mt-4">
                	<div class="text-md-right">
		                <div class="float-lg-left">

<button class="btn btn-success btn-icon icon-left" name="b_print" onClick="printdiv('div_print');"><i class="fas fa-print"></i> Print Report </button>
<a class="btn btn-info btn-icon icon-left" href="<?php echo $baseurl;?>report/<?php echo $id?>.html"><i class="fas fa-print"></i>Print Report With Header</a>
		                </div>
		            </div>
                </div>

            </div>
            
          </div>
        </section>

<?php

include("includes/footer.php");
?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  
</body>


</html>