<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $owner = $_POST['owner'];
    $cnic = $_POST['cnic'];
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $ratio = $_POST['profit_share'];
    $address = $_POST['address'];
    $outsource = $_POST['outsource'];
    $active = $_POST['active'];
    $password = $_POST['password'];
    
    $dir='../images';
    $name=basename($_FILES['logo']['name']);
    $t_name=$_FILES['upload_file']['tmp_name'];
    
    $frenshises=mysqli_query($con,"select * from frenchises where id='$id' ") or die (mysqli_error());

    while($info=mysqli_fetch_array($frenshises)){
    
        $logo = $info['logo'];
        $pass = $info['password'];
    }

    if(!empty($name)){
        
        if(move_uploaded_file($t_name,$dir.'/'.$name)){

            $l = "images/$name";
        }
        
    } else {
       $l = $logo;
    }
    
    if(!empty($password)){
        $p = md5($password);
    } else {
       $p = $pass;
    }
    
    if($_POST['outsource'] == "on")
    {
        $outsource = 1;   
    }
    else 
    {
        $outsource = 0;
    }
    if($_POST['active'] == "on")
    {
        $active = 1;   
    }
    else 
    {
        $active = 0;
    }


mysqli_query($con,"update frenchises set username='$username',owner='$owner',cnic='$cnic',contact='$contact',address='$address', city='$city',email='$email',website='$website',profit_share='$ratio',outsource='$outsource',active='$active', logo='$l', password = '$p' where id='$id' limit 1") or die (mysqli_error($con));
	$message='<font color="green">Frenshise has been updated successfully</font>';



}

$frenshises=mysqli_query($con,"select * from frenchises where id='$id' ") or die (mysqli_error());

while($info=mysqli_fetch_array($frenshises)){

    $username = $info['username'];
    $owner = $info['owner'];
    $cnic = $info['cnic'];
    $contact = $info['contact'];
    $city = $info['city'];
    $email = $info['email'];
    $website = $info['website'];
    $ratio = $info['profit_share'];
    $address = $info['address'];
    $outsource = $info['outsource'];
    $logo = $info['logo'];
    $active = $info['active'];
    $password = $info['password'];
}




?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $username;?>'s Profile | <?php echo $basetitle;?></title>
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
<h1><?php echo $username;?>'s Info</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>frenchise_info.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Frenchise Information</h4>
                  </div>
                  <div class="card-body">
            <div class="form-group">  <div class="checkbox">
  <label>
      <?php if ($outsource == '1'){
          echo '<input type="checkbox" name="outsource" checked>';
      } else {
            echo '<input type="checkbox" name="outsource">';
      }
      ?>
 <strong>Outsource</strong></label>
</div></div>
      <div class="form-group">  <div class="checkbox">
  <label>
      <?php if ($active == '1'){
          echo '<input type="checkbox" name="active" checked>';
      } else {
            echo '<input type="checkbox" name="active">';
      }
      ?>
 <strong>Active</strong></label>
</div></div>
                    <div class="form-group">
<label>Username</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="username" value="<?php echo $username;?>">
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
<input type="text" class="form-control" name="owner" value="<?php echo $owner;?>">
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
<input type="text" class="form-control" name="cnic" value="<?php echo $cnic;?>">
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
                    <div class="form-group">
<label>Email</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
                        </div>
<input type="email" class="form-control" name="email" value="<?php echo $email;?>">
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
<input type="text" class="form-control datemask" placeholder="Address" name="address" value="<?php echo $address;?>">
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
<input type="text" class="form-control datemask"  name="website" value="<?php echo $website;?>">
</div>
    <div class="form-group">
<label>Logo</label>  <a href="<?php echo 'https://virtuallab.com.pk/'. $logo; ?>"> Click here </a> 
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
<input type="number" class="form-control" name="ratio" min="1" placeholder="Only Numbers" value="<?php echo $ratio;?>">
                      </div>
                    </div>

    <div class="form-group">
<label>Set new password</label>
<div class="input-group">
    <input type="password" class="form-control" name="password" placeholder="Minimum 8 characters " min='8' >
                      </div>
                    </div>

                    <div class="form-group">
<input type="submit" name="submit" value=" Update Frenchise " class="btn btn-block btn-info">                 
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