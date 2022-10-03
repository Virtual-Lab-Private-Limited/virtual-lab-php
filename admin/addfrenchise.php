<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

if(isset($_POST['submit'])) {

$username= $_POST['username'];
$owner= $_POST['owner'];
$cnic= $_POST['cnic'];
$contact= $_POST['contact'];
$email= $_POST['email'];
$address= $_POST['address'];
$ratio= $_POST['ratio'];
$city= $_POST['city'];
$website= $_POST['website'];
$password= $_POST['password'];
$encrypt_password= md5($password);

if($_POST['outsource'] == "on")
{
    $outsource = 1;   
}
else 
{
    $outsource = 0;
}


$dir='../images';
$name=basename($_FILES['logo']['name']);
$t_name=$_FILES['logo']['tmp_name'];


$query=mysqli_query($con,"select * from frenchises where username='$username' limit 1") or die (mysqli_error($con));
$count=mysqli_num_rows($query);

if($count>0){
	$message='<font color="red">Username is already issued to another Frenchise</font>';
} else {
   
    move_uploaded_file($t_name,  $dir.'/'.$name);
    mysqli_query($con,"insert into frenchises (owner, username, website, city, contact, cnic, email, address, profit_share, password, outsource, logo)
    values('$owner','$username','$website','$city','$contact','$cnic','$email','$address','$ratio','$encrypt_password','$outsource','members/$name')") or die (mysqli_error($con));
    $message='<font color="green">Frenchise has been added successfully</font>';
        	email($username, $owner, $email, $password);
   
    }

}

function email($username, $owner, $email, $password){
    $to = "$email";
    $subject = "Frenchise Created";
    
    $message = "
    <html>
    <head>
    <title>Frenchise Created</title>
    </head>
    <body>
    <h4>Dear ".$owner."</h4>
    <p>Congratulations, Your frenchise portal with Virtual Lab has been created.</p>
    
    <p>Please save following credentials to login to <a href='https://virtuallab.com.pk/frenchise/'>portal</a> :</p>
    <div><strong>Username: </strong> ".$username."</div>
    <div><strong>Password: </strong> ".$password."</div>
    
    <p>We wish you all the best!</p>
    
    <div><strong>
    Best Regards,</strong></div>
    <div>Virtual Lab Team</div>
    
    </body>
    </html>
    ";
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <no-reply@virtuallab.com.pk>' . "\r\n";
   
    
    mail($to,$subject,$message,$headers);
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Frenchise | <?php echo $basetitle;?></title>
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
<h1>Add Frenchise / Branch</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>addfrenchise.html" method="post" enctype="multipart/form-data"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Frenchise Information</h4>
                  </div>
                  <div class="card-body">
                      <div class="form-group">  <div class="checkbox">
  <label><input type="checkbox" name="outsource"> <strong>Outsource</strong></label>
</div></div>
                    <div class="form-group">
<label>Username</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="username" required>
                      </div>
                    </div>
                    <div class="form-group">
<label>Owner Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="owner" required>
                      </div>
                    </div>
                      <div class="form-group">
<label>Cnic</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-file"></i>
</div>
                        </div>
<input type="text" class="form-control" name="cnic" required>
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
<input type="text" class="form-control" name="contact" required>
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
<input type="email" class="form-control" name="email" required>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
              	<div class="card">
                  <div class="card-header">

                  </div>
                  <div class="card-body">

                    <div class="form-group">
<label>Address</label>
<input type="text" class="form-control datemask" placeholder="Address" name="address" required>
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
<label>Website</label>
<input type="text" class="form-control datemask"  name="website" >
</div>
    <div class="form-group">
<label>Logo</label>
<input type="file" class="form-control datemask"  name="logo" >
</div>
                     <div class="form-group">
<label>Profit Ratio</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-money"></i>
</div>
                        </div>
<input type="number" class="form-control" name="ratio" min="1" placeholder="Only Numbers" required>
                      </div>
                    </div>

    <div class="form-group">
<label>Set Password</label>
<div class="input-group">
    <input type="password" class="form-control" name="password" placeholder="Minimum 8 characters " min='8' required >
                      </div>
                    </div>

                    <div class="form-group">
<input type="submit" name="submit" value=" Add Frenchise " class="btn btn-block btn-info">                 
</div>

<?php echo $message;?>
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