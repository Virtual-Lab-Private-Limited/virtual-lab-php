<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0 || ($session_role == 'user')){
	header("location:".$baseurl."login.html");
	exit();
}
$message='';

if(isset($_GET['id'])){

$id = $_GET['id'];
mysqli_query($con,"update out_city_requests set resolve=1 where id='$id' ") or die (mysqli_error($con));
	
$message='<font color="green">Request has been resolved successfully</font>';
	
	header("location:".$baseurl."out_city.php");
    
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
<h1>Add New Request</h1>
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
<th>Case No</th>
<th>Courier No</th>
<th>Expected Delivery</th>
<th>Collection Center ID</th>
<th>Collection Center Address</th>
<th>Collection Center Contact</th>

<th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
<?php
$requests=mysqli_query($con,"select * from out_city_requests where labid='$session_labid' and resolve=0 order by date asc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($requests)){

?>
                          <tr>
<td><?php echo $info['caseno'];?></td>
<td><?php echo $info['courier_no'];?></td>
<td><?php echo $info['date'].' at '.$info['time'];?></td>
<td><?php echo $info['center_id'];?></td>
<td><?php echo $info['center_address'];?></td>
<td><?php echo $info['contact'];?></td>

<td width="14%">
<a href="<?php echo $baseurl;?>out_city.php?id=<?php echo $info['id'];?>" class="btn btn-success"> Resolve</a>
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