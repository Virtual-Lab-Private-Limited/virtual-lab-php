<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}if(isset($_POST['submit'])){
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$cnic=$_POST['cnic'];
$contact=$_POST['contact'];
$city=$_POST['city'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$password=md5($_POST['password']);
$pass=$_POST['password'];
$gender=$_POST['gender'];

$cnic_query=mysqli_query($con,"select * from investors where cnic='$cnic' limit 1") or die (mysqli_error($con));

$count_cnic=mysqli_num_rows($cnic_query);


if($count_cnic>0){
	$message='<font color="red">CNIC is already exist</font>';
}else{
mysqli_query($con,"insert into investors (firstname,lastname,cnic,contact,city,dob,address,password,pass,gender,status,signup_date)values('$firstname','$lastname','$cnic','$contact','$city','$dob','$address','$password','$pass','$gender','Active',now())") or die (mysqli_error($con));
	$message='<font color="green">Invester has been added successfully</font>';
}


}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Patient | <?php echo $basetitle;?></title>
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
<h1>Add New Patient</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="add_investor.html" method="post"> 
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
<input type="text" class="form-control" name="firstname" value="">
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
<input type="text" class="form-control" name="lastname" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>CNIC</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-address-card"></i>
</div>
                        </div>
<input type="text" class="form-control" name="cnic" value="">
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
<input type="text" class="form-control" name="contact" value="">
                      </div>
                    </div>
                                    <div class="form-group">
<label>Select City</label>
<select class="form-control select2" name="city">
<?php
$types=mysqli_query($con,"select * from cities") or die (mysqli_error());
while($data=mysqli_fetch_array($types)){ 

?>
<option value="<?php echo $data['city'];?>"><?php echo $data['city'];?></option>
<?php
}
?>
                      </select>
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
<label>Gender</label>
<div class="input-group">
<select name="gender" class="form-control">
<option>Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
                      </div>
                    </div>
                    <div class="form-group">
<label>DOB</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-calendar"></i>
</div>
                        </div>
<input type="text" class="form-control" name="dob" value="">
                      </div>
                    </div>

                    <div class="form-group">
<label>Address</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-calendar-check"></i>
</div>
                        </div>
<input type="text" class="form-control" name="address" value="">
                      </div>
                    </div>
                     <div class="form-group">
<label>Password</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-eye-slash"></i>
</div>
                        </div>
<input type="text" class="form-control" name="password" value="<?php echo rand(0,9999);?>">
                      </div>
                    </div>
                    <div class="form-group">
<input type="submit" name="submit" value=" Add Investor " class="btn btn-block btn-info">                    </div>
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