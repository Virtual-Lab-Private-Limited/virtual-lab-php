<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0 || ($session_role == 'user')){
	header("location:".$baseurl."login.html");
	exit();
}


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

$password=md5(123456);

$doctors=mysqli_query($con,"select * from collection_center where phc_number='$phc_number' ") or die (mysqli_error($con));
$count_doctor=mysqli_num_rows($doctors);

if($count_doctor>0){

$message='<font color="red"><p align="center">Collection center with following PHC number already exsists.</p>
</font>
'; 


}else{
    
$records=mysqli_query($con,"select unique_id from collection_center order by id desc limit 1") or die (mysqli_error($con));
if(mysqli_num_rows($records) > 0) {
    while($row=mysqli_fetch_array($records)){
        $unique_id = $row['unique_id'];
    }    
    $u_id = $unique_id + 1;
} else {
    $u_id = 100;    
}

mysqli_query($con,"insert into collection_center ( unique_id, firstname,lastname,email,contact,address,city,qualification, phc_number, password, labid) 
 values ('$u_id','$fname','$lname','$mail','$phone','$new_address','Lahore','$qualification','$phc_number','$password', '$session_labid') ") or die (mysqli_error($con));
$cid = mysqli_insert_id($con);
foreach ($discounts as $index => $value) {
    
    mysqli_query($con, "insert into collection_center_discounts(cc_id,discount_id,discount) 
     values ('$cid','$dids[$index]','$value') ") or die(mysqli_error($con));
    
}

$message='<font color="green">New Center has been added successfully</font>';

}}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Collection Center </title>
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
<h1>Add Collection Center</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>add_center.php" method="post"> 
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
<input type="text" class="form-control" name="firstname" placeholder="First Name" >

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="lastname" placeholder="Last Name" >
                      </div>
                    </div>
                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
                        </div>
<input type="text" placeholder="Email" class="form-control" name="email" >
                      </div>
                    </div>
                              <div class="form-group">
<input type="text" placeholder="City" class="form-control" name="city" value="Lahore"  readonly>
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
<input type="text" class="form-control" name="contact" placeholder="Contact Number" >
                      </div>
                    </div>
                    <div class="form-group">
<input type="text" class="form-control" placeholder="Education" name="qualification" >
</div>
              <div class="form-group">
<input type="text" class="form-control" placeholder="Exact Address" name="address" >
</div>
                    <div class="form-group">
<input type="text" class="form-control" name="phc_number" placeholder="PHC number" required>
</div>

                   </div>
                  </div>
              </div>
              <div class="col-12 col-md-4 col-lg-4">
              	<div class="card">
                  <div class="card-body">
      

<?php

$discounts=mysqli_query($con,"select * from discounts") or die (mysqli_error($con));

while($discount=mysqli_fetch_array($discounts)){ ?>
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text" >
    <?php echo $discount['title']; ?>
    <input type="hidden" name="discount_id[]" value="<?php echo $discount['id']; ?>"  >

 
</div>
                        </div>
<input type="number" class="form-control" name="discount[]" placeholder="Enter discount" value='0' >
                      </div>
                    </div>
    
<?php
    
}

?>

                    <div class="form-group">
<input type="submit" class="btn btn-info btn-block" name="submit" value=" Add Center ">
</div>

<div class="form-group">
<label>Default Password is 123456</label>
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