<?php
include("global.php");
include("frenchiseinfo.php");

  
if(isset($_POST['submit'])){

$username=$_POST['username'];
$email=$_POST['email'];
$newpass=$_POST['password'];
$cpass=$_POST['cpass'];
 
if($newpass!=$cpass){

$message='<font color="red">Both Passwords are not Matched</font>';	
	
}
else{
	$query=mysqli_query($con,"SELECT * from members WHERE username='$username' AND  email='$email' and status='Active' and member_type=1 LIMIT 1") or die (mysqli_error());
	$count_query=mysqli_num_rows($query);
	
	print_r($count_query);

	if($count_query==0){
        $message='<font color="red"><p align="center">Invaild Username/Email</p></font>';
     
	} else {
	    $npass=md5($newpass);

        mysqli_query($con,"update members set 
        password='$npass' where username='$username' AND  email='$email' limit 1") or die (mysqli_error($con));
        $message='<font color="green"><p align="center">Your password has been reset successfully. Go to <a href="login.html">home page</a> and login</p></font>';
 
        //	header("location:".$baseurl."home.html");
        }
	}


}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Change Password | <?php echo $basetitle;?></title>
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
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
<div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
<h1>Forgot Password?</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>forgotpassword.php" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Set New Password</h4>
                  </div>
                  <div class="card-body">
                      <?php echo $message;?>
                       <div class="form-group">
<label>Username</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-eye-slash"></i>
</div>
                        </div>
<input type="text" class="form-control" name="username" value="">
                      </div>
                    </div>
                      <div class="form-group">
<label>Email</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-eye-slash"></i>
</div>
                        </div>
<input type="text" class="form-control" name="email" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>New Password</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-eye-slash"></i>
</div>
                        </div>
<input type="password" class="form-control" name="password" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>Confirm Password</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-eye-slash"></i>
</div>
                        </div>
<input type="password" class="form-control" name="cpass" value="">
                      </div>
                    </div>
                                        <div class="form-group">
<input type="submit" name="submit" value=" Set Password " class="btn btn-block btn-info">                    </div>
                  
                  </div>


                </div>
              </div>

            </div>
</form>
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