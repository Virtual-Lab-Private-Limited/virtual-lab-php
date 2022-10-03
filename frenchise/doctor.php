<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];
$doctors=mysqli_query($con,"select * from  frenchise_doctor where id='$id' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($doctors)){
	$firstname=$info['firstname'];
    $lastname=$info['lastname'];
    $email=$info['email'];
    $phone=$info['phone'];
    $gender=$info['gender'];
    $address=$info['address'];
    $city=$info['city'];
    $education=$info['education'];
    $designation=$info['designation'];
    $department=$info['department'];
    $pmdc=$info['pmdc'];
    $priority=$info['priority'];
}

if(isset($_POST['submit'])){
$fname=mysqli_real_escape_string($con,$_POST['firstname']);
$lname=mysqli_real_escape_string($con,$_POST['lastname']);
$mail=mysqli_real_escape_string($con,$_POST['email']);
$phone=mysqli_real_escape_string($con,$_POST['contact']);
$new_address=mysqli_real_escape_string($con,$_POST['address']);
$sex=mysqli_real_escape_string($con,$_POST['gender']);
$qualification=mysqli_real_escape_string($con,$_POST['education']);
$designation=mysqli_real_escape_string($con,$_POST['designation']);
$department=mysqli_real_escape_string($con,$_POST['department']);
$pmdc=$_POST['pmdc'];
$priority=$_POST['priority'];


mysqli_query($con,"update frenchise_doctor set firstname='$fname',lastname='$lname',email='$mail',phone='$phone',
address='$new_address',education='$qualification',department='$department',designation='$designation',priority='$priority', pmdc='$pmdc' where id='$id' limit 1") or die (mysqli_error($con));
$message='<font color="green">Doctor Information has been Updated successfully</font>';



}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $firstname.' '.$lastname;?>'s Profile | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
 <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css"> 
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
<h1><?php echo $firstname.' '.$lastname;?>'s Profile</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>doctor/<?php echo $id;?>" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
Priority Number
                          </div>
                        </div>
<input type="number" class="form-control" name="priority" value="<?php echo $priority;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname;?>">
                      </div>
                    </div>
                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
                        </div>
<input type="text" placeholder="Email" class="form-control" name="email" value="<?php echo $email;?>">
                      </div>
                    </div>
                                
                   
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4 col-lg-4">
              	<div class="card">
                  <div class="card-body">
                          <div class="form-group">
<input type="text" placeholder="Gender" class="form-control" name="gender" value="<?php echo $gender;?>" >
                    </div>
                                    <div class="form-group">
<input type="text" placeholder="Gender" class="form-control" name="city" value="<?php echo $city;?>" >
                    </div>

                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="contact" placeholder="Contact Number" value="<?php echo $phone;?>">
                      </div>
                    </div>
                    <div class="form-group">
<input type="text" class="form-control" placeholder="Education" name="education" value="<?php echo $education;?>">
</div>

                   </div>
                  </div>
              </div>
              <div class="col-12 col-md-4 col-lg-4">
              	<div class="card">
                  <div class="card-body">
                    <div class="form-group">
<input type="text" class="form-control" placeholder="Clinic / Hospital Address" name="address" value="<?php echo $address;?>">
</div>

                    <div class="form-group">
<input type="text" class="form-control" placeholder="Designation" name="designation" value="<?php echo $designation;?>">
</div>

                    <div class="form-group">
<input type="text" class="form-control" placeholder="Department" name="department" value="<?php echo $department;?>">
</div>

                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                          <div class="input-group-text">
PMDC
                          </div>
                        </div>
<input type="text" class="form-control" placeholder="PMDC Number" name="pmdc" value="<?php echo $pmdc;?>" required>
</div>
</div>
                    <div class="form-group">
<input type="submit" class="btn btn-info btn-block" name="submit" value=" Update Doctor ">
</div>

<div class="form-group">
<label>Default Password is 123456</label>
</div>
                   </div>
                  </div>
                <?php echo $message;?>
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
  <script src="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/mode/javascript/javascript.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/ckeditor.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>

</body>


</html>