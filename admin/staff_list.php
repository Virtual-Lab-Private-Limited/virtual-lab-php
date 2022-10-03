<?php
include("global.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
include("frenchiseinfo.php");
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Staff List | <?php echo $basetitle;?></title>
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
									<h1>Droplets</h1>
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
<th>Name</th>
<th>Position</th>
<th>Contact #</th>
<th width="9%">Status</th>
<th >Total Amount To Pay</th>
<th width="5%">Info</th>
<th width="5%">Change Password</th>
<th width="5%">History</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$staff_members=mysqli_query($con,"select r.id as rid, m.* from members m, rider r  where m.status='Active' and r.member_id=m.id order by m.member_type asc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($staff_members)){
    $rid = $info['rid'];

?>
                          <tr>
<td><?php echo $info['firstname'].' '.$info['lastname'];?></td>
<td><?php
$roleid=$info['member_type'];
$types=mysqli_query($con,"select * from roles where id='$roleid' limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($types)){
	echo $data['role'];

}
?></td>

<td><?php echo $info['contact'];?></td>
<td><?php echo $info['status'];?></td>
<?php
$earnings=mysqli_query($con,"SELECT sum(amount_to_pay) as total FROM rider_earnings WHERE r_id=$rid and paid=0  ") or die (mysqli_error($con));
while($data=mysqli_fetch_array($earnings)) { 
   $toPay =  $data['total'];
}

if ((int)$toPay > 2000) {
?>

<td style='background-color:pink; font-weight:bold'><?php echo $toPay;?></td>
<?php } else { ?>
<td ><?php echo $toPay;?></td>
<?php }  ?>


<td><a href="<?php echo $baseurl;?>change_info/<?php echo $info['id'];?>.html" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
<td><a href="<?php echo $baseurl;?>change_pass/<?php echo $info['rid'];?>.html" class="btn btn-success"><i class="fa fa-edit"></i></a>
</td>
<td><a href="<?php echo $baseurl;?>working_history/<?php echo $info['rid'];?>.html" class="btn btn-info"><i class="fa fa-eye"></i></a>
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