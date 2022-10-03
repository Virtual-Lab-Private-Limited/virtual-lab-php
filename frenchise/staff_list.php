<?php
include("global.php");
if($logged==0 || ($session_role == 'user') ){
	header("location:".$baseurl."login.html");
	exit();
}
include("frenchiseinfo.php");
if(isset($_GET['id'])){

$id = $_GET['id'];
mysqli_query($con,"delete from members where id='$id' ") or die (mysqli_error($con));
header("location:".$baseurl."staff_list.html");
    
}
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
									<h1>Users</h1>
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
<th>Contact #</th>
<th width="9%">Status</th>
<th width="5%">Info</th>
<th width="5%">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$staff_members=mysqli_query($con,"select m.* from members m where m.status='Active' and m.labid=$session_id and m.member_type=5 order by id asc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($staff_members)){
   

?>
                          <tr>
<td><?php echo $info['firstname'].' '.$info['lastname'];?></td>


<td><?php echo $info['contact'];?></td>
<td><?php echo $info['status'];?></td>
<td><a href="<?php echo $baseurl;?>change_info/<?php echo $info['id'];?>.html" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
<td><a href="<?php echo $baseurl;?>staff_list.php?id=<?php echo $info['id'];?>.html" class="btn btn-delete"><i class="fa fa-trash"></i></a></td>


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