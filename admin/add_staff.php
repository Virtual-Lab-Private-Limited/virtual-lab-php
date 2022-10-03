<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}if(isset($_POST['submit'])){
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$labid=$_POST['labid'];

$username=$_POST['username'];
$role=$_POST['role'];
$pass = $_POST['password'];
$password=md5($_POST['password']);
$dob=$_POST['dob'];
$doj=$_POST['doj'];
$qualification=$_POST['qualification'];
$salary=$_POST['salary'];
$contact=$_POST['contact'];
$city=$_POST['city'];
$cnic=$_POST['cnic'];
$status='Active';

$contact_query=mysqli_query($con,"select * from members where contact='$contact' limit 1") or die (mysqli_error($con));

$count_contact=mysqli_num_rows($contact_query);

if($count_contact>0){
	$message='<font color="red">This Contact is already issued to another Staff Member</font>';
}else if(strlen($pass)<8){
    $message='<font color="red">Password minimum length should be 8</font>';
}else{


mysqli_query($con,"insert into members (firstname,lastname,username,email,contact,dob,password,member_type,status,doj,qualification,salary,city,cnic,labid,lati,longi,name,path,payment_method,details)
values('$firstname','$lastname','$username','$email','$contact','$dob','$password','$role','$status','$doj','$qualification','$salary','$city','$cnic','$labid','','','N/A','N/A','Not Set','')") or die (mysqli_error($con));
$member_id = mysqli_insert_id($con);
if($role == 4){
    $riders = mysqli_query($con, "select * from rider order by id desc limit 1") or die(mysqli_error());
    
    $count = mysqli_num_rows($riders);
    if($count>0){
        while ($data = mysqli_fetch_array($riders)) {
            $uid = $data['unique_id'];
        }
        $uid = $uid+1;
    } else {
        $uid = 100;
    }
    
    mysqli_query($con,"insert into rider (unique_id,member_id,contact,password) values ('$uid','$member_id','$contact','$password' )")  or die (mysqli_error($con));
}

$message='<font color="green">Staff Member has been added successfully</font>';

}

}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Staff Member | <?php echo $basetitle;?></title>
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
<form action="add_staff.html" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
             
                <div class="card">
                  <div class="card-header">
<h4>Personal Information</h4>
                  </div> 
                  
                  <div class="card-body">
                         <?php echo $message;?>
                    <div class="form-group">
<label>First Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="firstname" value="" required>
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
<input type="text" class="form-control" name="lastname" value="" required>
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
<input type="text" class="form-control" name="email" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>Username</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-globe"></i>
</div>
                        </div>
<input type="text" class="form-control" name="username" value="">
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

                    <div class="form-group">
<label>Contact</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="contact" value="" required>
                      </div>
                    </div>
                    <div class="form-group">
<label>Date of Birth</label>
<input type="text" class="form-control datemask" placeholder="YYYY/MM/DD" name="dob" value="">
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
<label>Date of Joining</label>
<input type="text" class="form-control datemask" placeholder="YYYY/MM/DD" name="doj" value="">
</div>
                    <div class="form-group">
<label>Qualification</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="qualification" value="">
                      </div>
                    </div>
                     <div class="form-group">
<label>Salary</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="salary" value="">
                      </div>
                    </div>
                                    <div class="form-group">
<label>Select Roles</label>
<select class="form-control select2" name="role">
<?php
$types=mysqli_query($con,"select * from roles") or die (mysqli_error());
while($data=mysqli_fetch_array($types)){ 

?>
<option value="<?php echo $data['id'];?>"><?php echo $data['role'];?></option>
<?php
}
?>
                      </select>
                    </div>
                                   
                      <div class="form-group">
<label>CNIC</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            #
                          </div>
                        </div>
<input type="text" class="form-control" name="cnic"  value="">
                      </div>
                    </div>

                    <div class="form-group">
<label>Set Password</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-globe"></i>
</div>
                        </div>
<input type="text" class="form-control" name="password" required>
                      </div>
                    </div>
                    <div class="form-group">
<input type="submit" name="submit" value=" Add Member " class="btn btn-block btn-info">                    </div>

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