<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];

$centers=mysqli_query($con,"select * from  collection_center where id='$id' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($centers)){
	$firstname=$info['firstname'];
$lastname=$info['lastname'];
$email=$info['email'];
$phone=$info['contact'];
$address=$info['address'];
$city=$info['city'];
$education=$info['qualification'];
$c_id = $info['id'];
$unique_id = $info['unique_id'];
$phc_number=$info['phc_number'];
}
$cc_discount=mysqli_query($con,"select * from  collection_center_discounts  where cc_id='$id' order by id asc ") or die (mysqli_error());



if(isset($_POST['submit'])){
$fname=mysqli_real_escape_string($con,$_POST['firstname']);
$lname=mysqli_real_escape_string($con,$_POST['lastname']);
$mail=mysqli_real_escape_string($con,$_POST['email']);
$phone=mysqli_real_escape_string($con,$_POST['contact']);
$new_address=mysqli_real_escape_string($con,$_POST['address']);
$qualification=$_POST['qualification'];
$phc_number=$_POST['phc_number'];
$discounts = $_POST['discount'];
$dids = $_POST['discount_id'];

mysqli_query($con,"update collection_center set firstname='$fname',lastname='$lname',email='$mail',contact='$phone',address='$new_address',qualification='$qualification'
, phc_number='$phc_number' where id='$c_id' limit 1") or die (mysqli_error($con));

foreach ($discounts as $index => $value) {

    mysqli_query($con, "update collection_center_discounts set discount = '$value' where cc_id = '$id' and discount_id = '$dids[$index]' ") or die(mysqli_error($con));
    
}

$message='<font color="green">Center Information has been Updated successfully</font>';



}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $firstname.' '.$lastname;?>'s Center | <?php echo $basetitle;?></title>
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
<h1><?php echo $firstname.' '.$lastname;?>'s Center</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>update_center.php?id=<?php echo $id;?>" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname;?>">
<input type="text" class="form-control"  value="VLC-<?php echo $unique_id;?>" readonly>

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
                     <div class="form-group">
<input type="text"  class="form-control" name="city" value="<?php echo $city;?>" readonly>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4 col-lg-4">
              	<div class="card">
                  <div class="card-body">
                                   
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
<input type="text" class="form-control" placeholder="Education" name="qualification" value="<?php echo $education;?>">
</div>              
<div class="form-group">
<input type="text" class="form-control" placeholder="Clinic / Hospital Address" name="address" value="<?php echo $address;?>">
</div>
                    <div class="form-group">
<input type="text" class="form-control" name="phc_number" value="<?php echo $phc_number;?>" required>
</div>

                   </div>
                  </div>
              </div>
              <div class="col-12 col-md-4 col-lg-4">
              	<div class="card">
                  <div class="card-body">
      <?php


while($cc = mysqli_fetch_array($cc_discount)){ ?>
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text" >
    <?php 
    $discounts=mysqli_query($con,"select * from discounts where id= ".$cc['discount_id']." limit 1 ") or die (mysqli_error($con));
    while($discount = mysqli_fetch_array($discounts)) { 
        echo $discount['title']; 
    } ?>
    <input type="hidden" name="discount_id[]" value="<?php echo $cc['discount_id']; ?>"  >
</div>
                        </div>
<input type="number" class="form-control" name="discount[]" placeholder="Enter discount" value='<?php echo $cc['discount']; ?>' >
                      </div>
                    </div>
    
<?php
    
}

?>

                    <div class="form-group">
<input type="submit" class="btn btn-info btn-block" name="submit" value=" Update Center ">
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