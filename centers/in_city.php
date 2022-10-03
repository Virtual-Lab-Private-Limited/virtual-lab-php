<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$message='';

if(isset($_POST['submit'])){
$caseno=$_POST['caseno'];
$date=$_POST['date'];
$time=$_POST['time'];
$contact=$_POST['contact'];


mysqli_query($con,"insert into in_city_requests (caseno, date, time, contact, center_address, center_id, labid)
values('$caseno','$date','$time','$contact','$session_address','$session_uid','$session_labid')") or die (mysqli_error($con));
	
$today = date("d m Y h:i:s A");
         
mysqli_query($con, "insert into notifications (message, datetime, resolved, frenchise, labid) values ('New in-city sample collection request has been made by 
$session_uid ','$today', 0, 1, '$session_labid') ")
    or die(mysqli_error($con));
	
	
$message='<font color="green">Request has been added successfully</font>';
	
	
    
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
<form action="in_city.php" method="post"> 
           
               <div class="card">
                        <div class="card-body">
                             <div class="row">
           <div class="col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="caseno" value="" placeholder=" Case No " required>
                      </div>
                    </div>
           
                    <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                    <i class="fas fa-address-card"></i>
                    </div>
                        </div>
<input type="date" class="form-control" name="date" value="" placeholder=" Date ">
                      </div>
                    </div>
                  </div>
          
              <div class="col-12 col-md-6 col-lg-6">
              
                
                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-clock"></i>
</div>
                        </div>
<input type="time" class="form-control" name="time" value="" placeholder=" Time ">
                      </div>
                    </div>
                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="contact" value="" placeholder=" Relevant Contact" required>
                      </div>
                    </div>

                    
  
                   </div>
                   <div class="row" style="text-align:right; padding:20px">
<input type="submit" name="submit" value=" Add Request " class="btn btn-block btn-info">      <?php echo $message;?>          
</div>
                  </div>
              
              </div>

            </div>
</form>
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
<th>Date</th>
<th>Time Slot</th>
<th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
<?php
$requests=mysqli_query($con,"select * from in_city_requests where labid='$session_labid' and resolve=0 order by date asc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($requests)){

?>
                          <tr>
<td><?php echo $info['caseno'];?></td>
<td><?php echo $info['date'];?></td>
<td><?php echo $info['time'];?></td>
<td width="14%">
<a href="<?php echo $baseurl;?>delete_incity_request.php?id=<?php echo $info['id'];?>" class="btn btn-success"><i class="fa fa-trash"></i> Delete</a>
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