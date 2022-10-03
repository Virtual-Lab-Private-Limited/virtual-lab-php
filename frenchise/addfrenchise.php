<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}if(isset($_POST['submit'])){
$title=mysqli_real_escape_string($con,$_POST['title']);
$meta=mysqli_real_escape_string($con,$_POST['meta']);
$keywords=mysqli_real_escape_string($con,$_POST['keywords']);
$description=mysqli_real_escape_string($con,$_POST['description']);
$contact=$_POST['contact'];
$email=$_POST['email'];
$address=mysqli_real_escape_string($con,$_POST['address']);
$google=mysqli_real_escape_string($con,$_POST['google']);
$ratio=$_POST['ratio'];
$city=$_POST['city'];
$whatsapp=$_POST['whatsapp'];
$services_charges=$_POST['services_charges'];
$frenchise_type=$_POST['frenchise_type'];
$status='Active';

$email_query=mysqli_query($con,"select * from webinfo where title='$title' limit 1") or die (mysqli_error($con));

$count_email=mysqli_num_rows($email_query);



if($count_email>0){
	$message='<font color="red">Username is already issued to another Staff Member</font>';
}else{
mysqli_query($con,"insert into webinfo (title,meta,keywords,description,contact,email,name,path,address,google,whatsapp,type,profit_ratio,status,services_charges,cityid)values('$title','$meta','$keywords','$description','$contact','$email','logo.png','images/logo.png','$address','$google','$whatsapp','$frenchise_type','$ratio','$status','$services_charges','$city')") or die (mysqli_error($con));
	$message='<font color="green">Frenchise has been added successfully</font>';
}


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
<form action="addfrenchise.html" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Frenchise Information</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
<label>Title</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="title" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>Meta</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="meta" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>Keywords</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
                        </div>
<input type="text" class="form-control" name="keywords" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>Description</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-globe"></i>
</div>
                        </div>
<input type="text" class="form-control" name="description" value="">
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
<label>Email</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
                        </div>
<input type="email" class="form-control" name="email" value="">
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
              	<div class="card">
                  <div class="card-header">
<h4>Frenchise Infromation</h4>
                  </div>
                  <div class="card-body">

                    <div class="form-group">
<label>Address</label>
<input type="text" class="form-control datemask" placeholder="Address" name="address" value="">
</div>

   <div class="form-group">
<label>Google Analytics</label>
<input type="text" class="form-control" placeholder="Google Analytics Code" name="google" value="">
</div>
                    <div class="form-group">
<label>Whatsapp</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-whatsapp"></i>
</div>
                        </div>
<input type="text" class="form-control" name="whatsapp" value="">
                      </div>
                    </div>
                     <div class="form-group">
<label>Profit Ratio</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-money"></i>
</div>
                        </div>
<input type="number" class="form-control" name="ratio" min="1" placeholder="Only Numbers" value="">
                      </div>
                    </div>
                     <div class="form-group">
<label>Services Charges</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-money"></i>
</div>
                        </div>
<input type="number" class="form-control" name="services_charges" min="1" placeholder="Only Numbers" value="">
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
<label>Frenchise Type</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                          T
                          </div>
                        </div>
<input type="text" class="form-control" name="frenchise_type"  value="Frenchise" readonly>
                      </div>
                    </div>

                    <div class="form-group">
<input type="submit" name="submit" value=" Add Frenchise " class="btn btn-block btn-info">                    </div>

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