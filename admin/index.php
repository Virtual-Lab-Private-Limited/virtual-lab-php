<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/flag-icon-css/css/flag-icon.min.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
  
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php
include("includes/header.php");
?>
<?php
include("includes/leftnavigation.php");

?>      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
									<h1>Dashboard</h1>
								</div>
							</div>
						</div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="card card-sales-widget card-bg-blue-gradient">
                <div class="card-icon shadow-primary bg-blue">
                  <i class="fas fa-user-plus"></i>
                </div>
                <div class="card-wrap pull-right">
                  <div class="card-header">
<h3>
<?php
$patients=mysqli_query($con,"select * from patients") or die (mysqli_error());
echo mysqli_num_rows($patients);
?>
</h3>
                    <h4>Total Patients</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="card card-sales-widget card-bg-yellow-gradient">
                <div class="card-icon shadow-primary bg-warning">
                  <i class="fas fa-drafting-compass"></i>
                </div>
                <div class="card-wrap pull-right">
                  <div class="card-header">
                    <h3><?php
$tests=mysqli_query($con,"select * from booking_details") or die (mysqli_error());
echo mysqli_num_rows($tests);
?></h3>
                    <h4>Total Tests</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="card card-sales-widget card-bg-orange-gradient">
                <div class="card-icon shadow-primary bg-hibiscus">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap pull-right">
                  <div class="card-header">
                    <h3><?php
$pendings=mysqli_query($con,"select * from booking_details where status='pending'") or die (mysqli_error());
echo mysqli_num_rows($pendings);
?></h3>
                    <h4>Pending Test</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="card card-sales-widget card-bg-green-gradient">
                <div class="card-icon shadow-primary bg-green">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap pull-right">
                  <div class="card-header">
                    <h3><?php
$complete=mysqli_query($con,"select * from booking_details where status='complete'") or die (mysqli_error());
echo mysqli_num_rows($pendings);
?></h3>
                    <h4>Complete Test</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
<?php
if($session_role==1){

?>
           <div class="row">
            
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Patients</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                       <th>Patient Name</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Action</th>
                      </tr>
<?php
$staff_members=mysqli_query($con,"select * from patients order by date_entry desc limit 10") or die (mysqli_error($con));
while($info=mysqli_fetch_array($staff_members)){

?>
                          <tr>
<td><?php echo $info['firstname'].' '.$info['lastname'];?></td>
<td><?php echo $info['cnic'];?></td>
<td><?php echo $info['contact'];?></td>
<td width="14%">
<a href="<?php echo $baseurl;?>patient_info/<?php echo $info['id'];?>.html" class="btn btn-info"> Info </a>
</td>
                          </tr>
<?php
}
?>                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pending Test Reports</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                      <th>Booking #</th>
<th>Name</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Test Title</th>
                      </tr>
<?php
$bookings=mysqli_query($con,"select * from booking_details where status='pending'  order by id desc limit 10") or die (mysqli_error($con));
while($info=mysqli_fetch_array($bookings)){

$books=mysqli_query($con,"select *  from bookings where id='".$info['bid']."'  limit 1") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){
	$bookingno=$book['bookingno'];	
}
?>
                          <tr>
<td><?php echo $bookingno;?></td>
<td><?php
$patients=mysqli_query($con,"select *  from patients where id='".$info['pid']."'  limit 1") or die (mysqli_error());
while($patient=mysqli_fetch_array($patients)){
echo $patient['firstname'].' '.$patient['lastname'];
$cnic=$patient['cnic'];
$contact=$patient['contact'];
$gender=$patient['gender'];
}

?></td>
<td><?php echo $cnic;?></td>
<td><?php echo $contact;?></td>
<td><?php
$tests=mysqli_query($con,"select *  from tests where id='".$info['tid']."'  limit 1") or die (mysqli_error());
while($test=mysqli_fetch_array($tests)){
echo	$test['title'];
	
}
?></td>

                          </tr>
<?php
}
?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
}else{
	?>
           <div class="row">
            
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Patients</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                       <th>Patient Name</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Action</th>
                      </tr>
<?php
$staff_members=mysqli_query($con,"select * from patients where labid='$session_labid' order by date_entry desc limit 10") or die (mysqli_error($con));
while($info=mysqli_fetch_array($staff_members)){

?>
                          <tr>
<td><?php echo $info['firstname'].' '.$info['lastname'];?></td>
<td><?php echo $info['cnic'];?></td>
<td><?php echo $info['contact'];?></td>
<td width="14%">
<a href="<?php echo $baseurl;?>patient_info/<?php echo $info['id'];?>.html" class="btn btn-info"> Info </a>
</td>
                          </tr>
<?php
}
?>                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pending Test Reports</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                      <th>Booking #</th>
<th>Name</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Test Title</th>
<th>Status</th>
                      </tr>
<?php
$bookings=mysqli_query($con,"select * from booking_details where status='pending' and labid='$session_labid' order by id desc limit 10") or die (mysqli_error($con));
while($info=mysqli_fetch_array($bookings)){

$books=mysqli_query($con,"select *  from bookings where id='".$info['bid']."'  limit 1") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){
	$bookingno=$book['bookingno'];	
}
?>
                          <tr>
<td><?php echo $bookingno;?></td>
<td><?php
$patients=mysqli_query($con,"select *  from patients where id='".$info['pid']."'  limit 1") or die (mysqli_error());
while($patient=mysqli_fetch_array($patients)){
echo $patient['firstname'].' '.$patient['lastname'];
$cnic=$patient['cnic'];
$contact=$patient['contact'];
$gender=$patient['gender'];
}

?></td>
<td><?php echo $cnic;?></td>
<td><?php echo $contact;?></td>
<td><?php
$tests=mysqli_query($con,"select *  from tests where id='".$info['tid']."'  limit 1") or die (mysqli_error());
while($test=mysqli_fetch_array($tests)){
echo	$test['title'];
	
}
?></td>

<td width="15%">
<a href="<?php echo $baseurl;?>create_report.php?id=<?php echo $info['tid'];?>&gender=<?php echo $gender;?>&bid=<?php echo $info['bid'];?>&pid=<?php echo $info['pid'];?>&bdid=<?php echo $info['id'];?>" class="btn btn-info">Report</a>
                            </td>
                          </tr>
<?php
}
?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
}?>
          
          
        </section>
	  </div>

<?php include("includes/footer.php");?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/echart/echarts.js"></script>
  
  <script src="<?php echo $baseurl;?>assets/bundles/chartjs/chart.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  
</body>


</html>