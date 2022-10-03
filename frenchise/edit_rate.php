<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];
$patients=mysqli_query($con,"select * from frenchise_details where id='$id' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($patients)){
	$tid=$info['testid'];
$rate=$info['rate'];
}

$tests=mysqli_query($con,"select * from tests where id='$tid' limit 1") or die (mysqli_error());
while($ts=mysqli_fetch_array($tests)){
 $test_title=$ts['title'];
}


if(isset($_POST['submit'])){
$amount=$_POST['amount'];
$tid=$_POST['tid'];

mysqli_query($con,"update frenchise_details set rate='$amount' where testid='$tid' and frenchiseid='$session_labid' limit 1") or die (mysqli_error($con));

echo '<script language="javascript">window.location = "'.$baseurl.'test_settings.html"</script>';




}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Change Rate | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
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
<h1>Change Rates</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>change_rate/<?php echo $id;?>.html" method="post"> 
            <div class="row">
              
              <div class="col-12 col-md-6 col-lg-6">
              	<div class="card">
                  <div class="card-header">
                    <h4><?php echo $test_title;?></h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
<label>Test Title</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-calendar"></i>
</div>
                        </div>
<input type="text" class="form-control" name="dob" value="<?php echo $test_title;?>" readonly>
<input type="hidden" class="form-control" name="tid" value="<?php echo $tid;?>">
                      </div>
                    </div>

                    <div class="form-group">
<label>Current Rate</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-calendar-check"></i>
</div>
                        </div>
<input type="text" class="form-control" name="amount" value="<?php echo $rate;?>">
                      </div>
                    </div>
                    <div class="form-group">
<input type="submit" name="submit" value=" Update Info " class="btn btn-block btn-info">                    </div>
                   </div>
                  </div>
                
              </div>


            </div>
</form>
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
<th>CNIC</th>
<th>Contact #</th>
<th>Test Title</th>
<th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$bookings=mysqli_query($con,"select * from booking_details where status='complete' and pid='$id' order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($bookings)){

$books=mysqli_query($con,"select *  from bookings where id='".$info['bid']."'  limit 1") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){
	$bookingno=$book['bookingno'];	
}
?>
                          <tr>
<td><?php echo $bookingno;?></td>
<td><?php echo $cnic;?></td>
<td><?php echo $contact;?></td>
<td><?php
$tests=mysqli_query($con,"select *  from tests where id='".$info['tid']."'  limit 1") or die (mysqli_error());
while($test=mysqli_fetch_array($tests)){
echo	$test['title'];
	
}
?></td>

<td width="5%">
<a href="<?php echo $baseurl;?>report/<?php echo $info['id'];?>.html" class="btn btn-info"><i class="fa fa-print"></i></a>
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
      </div>
<?php include("includes/footer.php");?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/forms-advanced-forms.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  
</body>


</html>