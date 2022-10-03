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
$vehicle_no = $info['vehicle_no'];
$status = $info['status'];

}
if(isset($_POST['submit'])){
$nfirstname=$_POST['firstname'];
$nlastname=$_POST['lastname'];
$nemail=$_POST['email'];
$nusername=$_POST['username'];
$ndob=$_POST['dob'];
$ndoj=$_POST['doj'];
$nqualification=$_POST['qualification'];
$nsalary=$_POST['salary'];
$ncontact=$_POST['contact'];
$ncity=$_POST['city'];
$ncnic=$_POST['cnic'];
$uid=$_POST['userid'];
$status=$_POST['status'];

mysqli_query($con,"update members set firstname='$nfirstname', lastname='$nlastname', username='$nusername',
email='$nemail', 
dob='$ndob',
doj='$ndoj',
qualification='$nqualification',
salary='$nsalary',
contact='$ncontact',
city='$ncity',
cnic='$ncnic',
status='$status'
where id='$uid' limit 1") or die (mysqli_error($con));

header("location:".$baseurl."staff_list.html");
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
<form action="<?php echo $baseurl;?>change_info/<?php echo $id;?>.html" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Personal Information</h4>
                  </div>
            <div class="card-body">
                <div class="form-group">
<label>Status</label>
                  <div class="input-group">
                    <select class="form-control" name="status">
                        <?php if ($status== 'Active') { ?>
                                <option value='Active'> Active</option>
                                <option value='Deactivate'> Deactivate</option>
                        <?php } else { ?>
                                
                                <option value='Deactivate'> Deactivate</option>
                                <option value='Active'> Active</option>
                        <?php } ?>
                    </select>
                     </div>
                    </div>
                    <div class="form-group">
<label>First Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="hidden" class="form-control" name="userid" value="<?php echo $id;?>">

<input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>">
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
<input type="text" class="form-control" name="lastname" value="<?php echo $lastname;?>">
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
<input type="text" class="form-control" name="email" value="<?php echo $email;?>">
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
<input type="text" class="form-control" name="username" value="<?php echo $username;?>">
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
<input type="text" class="form-control" name="city" value="<?php echo $city;?>">
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
<input type="text" class="form-control" name="contact" value="<?php echo $contact;?>">
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
<label>Date of Birth</label>
<input type="date" class="form-control datemask" placeholder="YYYY/MM/DD" name="dob" value="<?php echo $dob;?>">
</div>
   <div class="form-group">
<label>Date of Joining</label>
<input type="date" class="form-control datemask" placeholder="YYYY/MM/DD" name="doj" value="<?php echo $doj;?>">
</div>
                    <div class="form-group">
<label>Qualification</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-book"></i>
</div>
                        </div>
<input type="text" class="form-control" name="qualification" value="<?php echo $qualification;?>">
                      </div>
                    </div>
                     <div class="form-group">
<label>Salary</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-money-bill"></i>
</div>
                        </div>
<input type="text" class="form-control" name="salary" value="<?php echo $salary;?>">
                      </div>
                    </div>
                      <div class="form-group">
<label>CNIC</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            #
                          </div>
                        </div>
<input type="text" class="form-control" name="cnic"  value="<?php echo $cnic;?>">
                      </div>
                    </div>
                        

                    <div class="form-group">
<input type="submit" name="submit" value=" Update Member Info " class="btn btn-block btn-info" >                    </div>
                   </div>
                  </div>
                
              </div>


            </div>
</form>
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