<?php
include("global.php");
include("frenchiseinfo.php");

if ($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Settings | <?php echo $basetitle;?></title>
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
<h1>Settings</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>update_general.html" method="post" enctype="multipart/form-data">
         <div class="row">

              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">

        <div class="form-group">
<label>Title</label>
<div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-text-background"></i>
                  </div>
<input type="text" class="form-control" name="title" placeholder="Product Title" value="<?php echo $basetitle;?>" >
</div>
              </div>
<!--        <div class="form-group">-->
<!--<label>Tag Line</label>-->
<!--<div class="input-group">-->
<!--                  <div class="input-group-addon">-->
<!--                    <i class="glyphicon glyphicon-text-background"></i>-->
<!--                  </div>-->
<!--<input type="text" class="form-control" name="meta" placeholder="Product Title" value="<?php echo $basetagline;?>" >-->
<!--</div>-->
<!--              </div>-->
<!--        <div class="form-group">-->
<!--<label>Keywords</label>-->
<!--<div class="input-group">-->
<!--                  <div class="input-group-addon">-->
<!--                    <i class="glyphicon glyphicon-tag"></i>-->
<!--                  </div>-->
<!--<input type="text" class="form-control" name="keywords" placeholder="Product Keywords"  value="<?php echo $basekeywords;?>">-->
<!--</div>-->
<!--              </div>-->
<!--        <div class="form-group">-->
<!--<label>Description</label>-->
<!--<div class="input-group">-->
<!--                  <div class="input-group-addon">-->
<!--                    <i class="glyphicon glyphicon-tag"></i>-->
<!--                  </div>-->
<!--<input type="text" class="form-control" name="description" placeholder="Product Price only in Dollors"  value="<?php echo $basedescription;?>" >-->
<!--</div>-->
<!--              </div>-->
        <div class="form-group">
<label>Phone Number</label>
<div class="input-group">
            <div class="input-group-addon">
                    <i class="glyphicon glyphicon-phone"></i>
                  </div>
<input type="text" class="form-control" name="contact"  value="<?php echo $basephone;?>">
</div>
              </div>
               <div class="form-group">
<label>Email</label>
<div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-envelope"></i>
                  </div>
<input type="email" class="form-control" name="email" placeholder="Store Link" value="<?php echo $baseemail;?>" >
</div>
              </div>
</div>
</div>
</div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
       

        <div class="form-group">
<label>Address</label>
<div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-map-marker"></i>
                  </div>
<input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $baseaddress;?>" >
</div>
              </div>
        <div class="form-group"><label>Logo</label>

<div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-picture"></i>
                  </div>
	<input type="file" name="file_upload" class="form-control"/>
</div>
              </div>
<div class="form-group">
<label>App Discount</label>
<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-discount"></i>
                  </div>
<input type="text" class="form-control" name="discount" placeholder="App Discount" value="<?php echo $discount;?>" >
</div>
</div>              
        <div class="form-group">

	<input type="submit" name="submit" value=" Update General Web Settings " class="btn btn-info btn-block"/>
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