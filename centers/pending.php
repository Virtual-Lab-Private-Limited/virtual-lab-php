<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $list = $_POST['list'];
    $type = $_POST['type'];
    $courierno=$_POST['courierno'];
    $date=$_POST['date'];
    $time=$_POST['time'];
    $contact=$_POST['contact'];
    $today = date("d m Y h:i:s A");
       
    
    foreach ($list as $l){
        
        if($type == 'out'){
            mysqli_query($con,"insert into out_city_requests (caseno, courier_no, date, time, contact, center_address, center_id, labid)
            values('$l','$courierno','$date','$time','$contact','$session_address','$session_uid','$session_labid')") or die (mysqli_error($con));
            	
            mysqli_query($con, "insert into notifications (message, datetime, resolved, frenchise, labid) values ('New out-city sample collection request has been made by 
            $session_uid ','$today', 0, 1, '$session_labid') ")
                or die(mysqli_error($con));

        } else {
            mysqli_query($con,"insert into in_city_requests (caseno, date, time, contact, center_address, center_id, labid)
            values('$l','$date','$time','$contact','$session_address','$session_uid','$session_labid')") or die (mysqli_error($con));
                     
            mysqli_query($con, "insert into notifications (message, datetime, resolved, frenchise, labid) values ('New in-city sample collection request has been made by 
            $session_uid ','$today', 0, 1, '$session_labid') ")
                or die(mysqli_error($con));
            
        }
     
    }

}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Pending Reports | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
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
									<h1>Pending Reports</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
          <div class="row">
                <form action="pending.php" method="post"> 

                    <div class="col-12">
                <div class="card">
                  <div class="card-header">
                        <input type="date" class="form-control" name="date" value="" placeholder="Expected Delivery Date " required>
                        <input type="time" class="form-control" name="time" value="" placeholder="Expected Delivery Time " required>
                        <input type="text" class="form-control" name="contact" value="" placeholder=" Relevant Contact" required>
                        <input type="text" class="form-control" name="courierno" value="" placeholder=" Courier No " >
                        <select class="form-control" name="type">
                            <option value='in'>In City</option>
                            <option value='out'>Out City</option>
                        </select>

                        <input type='submit' value='Make Request' class='btn btn-warning'  /> 
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th width="10%">Booking #</th>
<th>Patient Code</th>
<th>Patient Name</th>
<th>No Of Tests</th>
<th width="12%">Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php



$books=mysqli_query($con,"select b.*  from bookings as b join booking_details as d on b.id=d.bid where d.status='pending' and b.cc_no='$session_uid'  group by b.bookingno order by b.id desc ") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){
	$bookingno=$book['bookingno'];	
	$bid =$book['id'];
?>
<tr>
<td><?php echo $bookingno;?></td>

<td><?php
$patients=mysqli_query($con,"select *  from patients where id='".$book['uid']."'  limit 1") or die (mysqli_error());
while($patient=mysqli_fetch_array($patients)){
echo $patient['patient_no'];
$name = $patient['firstname'].' '.$patient['lastname'];
$cnic=$patient['cnic'];
$contact=$patient['contact'];
$gender=$patient['gender'];
}
?></td>
<td><?php echo $name;?></td>
<td><?php
$bookings=mysqli_query($con,"select  *  from booking_details where status='pending' and bid = '".$bid."'") or die (mysqli_error());
$booking=mysqli_num_rows($bookings);
while($details=mysqli_fetch_array($bookings)){
    $testid = $details['tid'];

    $test=mysqli_query($con,"select  *  from tests where id='".$testid."' limit 1 ") or die (mysqli_error());
    while($t=mysqli_fetch_array($test)){
        echo $t['title'];
    } echo ', ';
}
?></td>
<td><a href="<?php echo $baseurl;?>patient_tests.php?id=<?php echo $bid;?>" class="btn btn-info">Status</a></td>
<td> <input type="checkbox" name='list[]' value='<?php echo $bookingno;?>' ></td>                            
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
                </form>
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