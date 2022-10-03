<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];
$members=mysqli_query($con,"select * from members where id='$id' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($members)){
$firstname=$info['firstname'];
$lastname=$info['lastname'];
$username=$info['username'];
$email=$info['email'];
$city=$info['city'];
$contact=$info['contact'];
$dob=$info['dob'];
$doj=$info['doj'];
$cnic=$info['cnic'];
$qualification=$info['qualification'];
$salary=$info['salary'];
$status=$info['status'];
$picture = $info['path'];
}
$transactions=mysqli_query($con,"select * from exam_payments where userid='$id' limit 1") or die (mysqli_error($con));
while($info=mysqli_fetch_array($transactions)){
$amount=$info['amount'];
$transactionid=$info['transactionid'];
$payment_method=$info['payment_method'];
$payment_date=$info['payment_date'];

}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Change Info | <?php echo $basetitle;?></title>
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
									<h1>Add Staff Member</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>sendmessage.php" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Personal Information</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
<label>First Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="hidden" class="form-control" name="userid" value="<?php echo $id;?>">

<input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="lastname" value="<?php echo $lastname;?>" readonly>
                      </div>
                    </div>
                    <div class="form-group">
<label>Email</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
                        </div>
<input type="text" class="form-control" name="email" value="<?php echo $email;?>" readonly>
                      </div>
                    </div>
                    <div class="form-group">
<label>City</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-globe"></i>
</div>
                        </div>
<input type="text" class="form-control" name="city" value="<?php echo $city;?>" readonly>
                      </div>
                    </div>
                    <div class="form-group">
<label>Contact</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="contact" value="<?php echo $contact;?>" readonly>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
              	<div class="card">
                  <div class="card-header">
                    <h4>Personal Infromation</h4>
                  </div>
                  <div class="card-body">
   <div class="form-group">
<label>Payment Date</label>
<input type="text" class="form-control datemask" placeholder="YYYY/MM/DD" name="doj" value="<?php echo $payment_date;?>" readonly>
</div>
                    <div class="form-group">
<label>Payment Method</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="qualification" value="<?php echo $payment_method;?>" readonly>
                      </div>
                    </div>
                     <div class="form-group">
<label>Amount</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="salary" value="<?php echo $amount;?>" readonly>
                      </div>
                    </div>
                      <div class="form-group">
<label>Payment Date</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            #
                          </div>
                        </div>
<input type="text" class="form-control" name="cnic"  value="<?php echo $payment_date;?>" readonly>
                      </div>
                    </div>

                    <div class="form-group">
<input type="submit" name="submit" value=" Update Member Info " class="btn btn-block btn-info">                    </div>
                   </div>
                  </div>
                
              </div>


            </div>
</form>
<h3>Applicant Picture</h3>
<div><a href="<?php echo 'https://virtuallab.com.pk/'.$picture;?>" target="_blank" >Click here to view</a></div>
<h3>Applicant Documents</h3>
<?php
$documents=mysqli_query($con,"select * from rider_documents where uid='$id'") or die (mysqli_error($con));
while($doc=mysqli_fetch_array($documents)){
 
?>
<div><a href="<?php echo 'https://virtuallab.com.pk/'.$doc['path'];?>" target="_blank" >Click here to view</a></div>
<?php
}
?>

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