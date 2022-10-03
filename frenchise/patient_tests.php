<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$bdid = $_POST['id'];	
    $dir = '../images';	
    $name = basename($_FILES['picture']['name']);
    $t_name = $_FILES['picture']['tmp_name'];
    
    if(move_uploaded_file($t_name,$dir.'/'.$name)){
        $p = "images/$name";
        $today = date("d m Y h:i:s A");
        mysqli_query($con,"update booking_details set status='Doctor', runtime_status='Report sent for pathologist approval', labid='$session_labid', result_date='$today', image='$p' where id='$bdid' limit 1 ") or die (mysqli_error($con));

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

?>
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
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th width="10%">Booking #</th>
<th>Test</th>
<th width="10%">Status</th>
<th width="12%">Report</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
  


$bookings=mysqli_query($con,"select *  from bookings where id='$id'") or die (mysqli_error());
while($info=mysqli_fetch_array($bookings)){
    $bookingno=$info['bookingno'];	
}

$books=mysqli_query($con,"select *  from booking_details where status='pending' and bid='$id'") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){

?>
                          <tr>
<td><?php echo $bookingno;?></td>
<td><?php


$tests=mysqli_query($con,"select *  from tests where id='".$book['tid']."'") or die (mysqli_error());
while($ts=mysqli_fetch_array($tests)){
echo	$ts['title'];	
$type = $test['type'];	

}
?></td>

<td><?php echo $book['runtime_status'];?></td>

<td>
<?php
  if($type == 'radiology_home' || $type == 'radiology_lab'){  ?>
    <form method="POST" action="<?php echo $baseurl;?>patient_tests/<?php echo $id;?>" enctype="multipart/form-data">
        <input type="file" class="form-control" name="picture"> 
        <input type="hidden" name="id" value=<?php echo $book['id']?> >
        <input type="submit" value=" Upload" class="btn btn-info">                  

    </form>
<?php  } else { ?>
<a href="<?php echo $baseurl;?>create_report/<?php echo $book['id'];?>" class="btn btn-info">Create Report</a>

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