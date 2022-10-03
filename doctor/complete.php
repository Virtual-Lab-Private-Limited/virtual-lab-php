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
  <title>Complete | <?php echo $basetitle;?></title>
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
  <div class="loader"></div>
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
									<h1> Verified Test</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Booking #</th>
<th>Name</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Test Title</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$bookings=mysqli_query($con,"select * from booking_details where status='complete' and labid='$session_labid' and approvedby='$session_id' order by id desc") or die (mysqli_error($con));
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
	$type = $test['type'];	
}
?></td>

<td width="25%">
<?php
  if($type == 'radiology_home' || $type == 'radiology_lab'){  ?>
    <a href="http://virtuallab.com.pk/<?php echo $info['image'];?>" target="_blank" class="btn btn-info">Report</a>
<?php  } else { ?>
    <a href="http://virtuallab.com.pk/reports/pdf.php?id=<?php echo $info['id'];?>" target="_blank" class="btn btn-info">Report</a>

<?php      
  }
?>

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