<?php
include("global.php");
//error_reporting(0);
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$bookings=mysqli_query($con,"select * from bookings where id='$id' order by bookingno desc limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($bookings)){
	$bookingno=$data['bookingno'];
	$pid=$data['uid'];
	$total_amount=$data['total_amount'];
	$test_date=$data['test_date'];
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

}


?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $basetitle;?></title>
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
<h1><?php echo $firstname.' '.$lastname;?>'s Test Report</h1>
								</div>
							</div>
						</div>
					</div>

          <div class="section-body">
            <div class="invoice">

              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                    	<div class="col-md-4">
                    		<div class="invoice-title">
		                      <div class="login-invoice login-invoice-color">
		            			<img alt="image" src="<?php echo $baseurl;?>assets/img/logo.png" height="30" /></div>
		            			</div>
                    	</div>
                    	<div class="col-md-8 align-right">
<address>14-E, Maulana Shaukat Ali Road, <br>Near Johar Event Hall, Lahore
<br>Download Virtual Lab APP from Google Play Store<br>
<strong>Ph: +92-42-35175500</strong>
</address>
                    	</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                      	<div class="card">
		                  <div class="card-header">
<strong>Patient Details:</strong>
		                  </div>
<div class="card-body">
<li>Full Name : <strong><?php echo $firstname.' '.$lastname;?></strong></li>
<li>Contact # : <strong><?php echo $contact;?></strong></li>
<li>City : <strong><?php echo $city;?></strong></li>
<li>Date of Birth : <strong><?php echo $dob;?></strong></li>
<li>Age : <strong><?php echo $age;?></strong></li>
<li>Blood Group : <strong><?php echo $blood_group;?></strong></li>
		                  </div>
		                </div>
                      </div>
                      <div class="col-md-4">
                      	<div class="card">
<div class="card-header">
<strong>Login Details:</strong>
</div>
<div class="card-body">
<li>Username : <strong><?php echo $cnic;?></strong></li>
<li>Password : <strong><?php echo $pass;?></strong></li>
<li>Web: https://virtuallab.com.pk/patient/login.html </li>
		                  </div>
		                </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
		                  <div class="card-header">
<strong>Invoice Details:</strong>
		                  </div>
<div class="card-body">
<li>Invoice # : <?php echo $bookingno;?></li>
<li>Dated : <?php echo $test_date;?></li>
<li>Total Amount : <?php echo $total_amount;?></li>
		                  </div>
		                </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md" border="1px">
                        <tr>
                          <th data-width="40">#</th>
<th>Test</th>
<th class="text-center" width="5%">Charges</th>
<th class="text-right" width="10%">Total</th>
                        </tr>

<?php
$a=1;
$test_details=mysqli_query($con,"select * from booking_details where bid='$id'") or die (mysqli_error());
while($tdata=mysqli_fetch_array($test_details)){
?>
                        <tr>
<td><?php echo $a++;?></td>
<td><?php $tid=$tdata['tid'];
$tests=mysqli_query($con,"select * from tests where id='$tid' limit 1") or die (mysqli_error());
while($row=mysqli_fetch_array($tests)){
echo $row['title'];	
}
$qty=$tdata['qty'];
?></td>
<td class="text-center"><?php $amount=$tdata['price']; echo $amount/$qty;?></td>
<td class="text-right">Rs. <?php echo $amount;?>/-</td>
                        </tr>
<?php
}
?>

                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total Amount</div>
                          <div class="invoice-detail-value">Rs. <?php echo number_format($total_amount,2);?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><hr>
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