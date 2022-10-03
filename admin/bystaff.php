<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

$id=$_GET['id'];
$bno=$_GET['bno'];
 

if(isset($id)){
 
    mysqli_query($con, "update bookings set test_status = 'Cancel' where id ='$id'") or die(mysqli_error($con));
    mysqli_query($con, "update booking_details set status = 'Cancel', runtime_status= 'Cancel by Admin' where bid ='$id'") or die(mysqli_error($con));
    mysqli_query($con, "delete from collection_center_earnings where b_no ='$bno'") or die(mysqli_error($con));
    
    header("location:".$baseurl."bystaff.html");
}

$did=$_GET['did'];
if(isset($did)){
    
    mysqli_query($con, "delete from bookings where id ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from booking_details where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from booking_rider where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from collection_center_earnings where b_no ='$bno'") or die(mysqli_error($con));
    mysqli_query($con, "delete from value_based_result where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from pcr_qualitative_result where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from pcr_quantitative_result where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from crossmatch_result where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from coagulation_result where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from analysis_result where bid ='$did'") or die(mysqli_error($con));
    mysqli_query($con, "delete from bloodgroup_result where bid ='$did'") or die(mysqli_error($con));
  
    
    header("location:".$baseurl."bystaff.html");
}


?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>By Staff Booking | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
 <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css"> 
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            
            <div class="row">
              <div class="col-12">
           <div class="section-body">
          <div class="row">
          
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped " id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Case #</th>
<th> Date</th>
<th>Patient #</th>
<th> Name </th>
<th>Contact</th>
<th>Tests</th>
<th>Bill</th>
<th>Status</th>
<th>Action</th>                      
</tr>
                        </thead>
                        <tbody>
<?php


$bookings=mysqli_query($con,"select * from bookings where addby='Staff' order by test_date desc") or die (mysqli_error($con));

while($info=mysqli_fetch_array($bookings)){
    	$bid =$info['id'];
?> <tr>
<td><?php echo $info['bookingno'];?></td>
<td><?php echo $info['test_date'];?></td>
<td><?php
$patients=mysqli_query($con,"select * from patients where id='".$info['uid']."' order by id") or die (mysqli_error());
while($data=mysqli_fetch_array($patients)){
    echo $data['patient_no'];
$name =  $data['firstname'].' '.$data['lastname'];
$contact = $data['contact'];
}?></td>
<td><?php echo $name;?></td>
<td><?php echo $contact;?></td>
<td><?php
$bd=mysqli_query($con,"select  *  from booking_details where bid = '".$bid."'") or die (mysqli_error());

while($details=mysqli_fetch_array($bd)){
    $testid = $details['tid'];
    $test=mysqli_query($con,"select  *  from tests where id='".$testid."' limit 1 ") or die (mysqli_error());
    while($t=mysqli_fetch_array($test)){
        echo $t['title'];
    } echo ', ';

}
?></td>
<td><?php echo $info['total_amount'];?></td>
<td><?php echo $info['test_status'];?></td>
<td width="5%">
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a href="<?php echo $baseurl.'invoice/'.$info['id'];?>.html" class="dropdown-item">Open Invoice</a>
    <a href="<?php echo $baseurl;?>bystaff.php?id=<?php echo $info['id'];?>&bno=<?php echo $info['bookingno'];?>" class="dropdown-item">Cancel Booking</a>
    <a href="<?php echo $baseurl;?>bystaff.php?did=<?php echo $info['id'];?>&bno=<?php echo $info['bookingno'];?>" class="dropdown-item">Delete Booking</a>
    <a href="<?php echo $baseurl;?>edit_booking.php?id=<?php echo $bid;?>" class="dropdown-item" target="_blank" >Edit Booking</a>

  </div>
</div>
                            </td>
                          </tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php include("includes/footer.php");?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/mode/javascript/javascript.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/ckeditor.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>

</body>


</html>