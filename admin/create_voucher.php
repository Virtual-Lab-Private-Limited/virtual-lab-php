<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
$code = $_POST['code'];
$discount = $_POST['discount'];
$max_uses = $_POST['max_uses'];
$max_uses_user = $_POST['max_uses_user'];
$starts_at = $_POST['starts_at'];
$expires_at = $_POST['expires_at'];

$description=mysqli_real_escape_string($con,$_POST['description']);

$query_tests=mysqli_query($con,"select * from vouchers where code='$code' limit 1") or die (mysqli_error());

$count_test=mysqli_num_rows($query_tests);
if($count_test>0){
$message='<font color="red"><p align="center">The Following Voucher already exsists</p></font>';	
}else{

    mysqli_query($con,"insert into vouchers(code,discount,uses,max_uses,max_uses_user,description,starts_at,expires_at) values 
    ('$code','$discount','0','$max_uses','$max_uses_user', '$description','$starts_at','$expires_at' )") or die (mysqli_error($con));

$message='<font color="green"><p align="center"> Your Voucher has been Created successfully</p>
</font>
'; 

}
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Create Voucher | <?php echo $basetitle;?></title>
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

           <div class="section-body">
<form action="<?php echo $baseurl;?>create_voucher.php" method="post" enctype="multipart/form-data">
         
          <div class="card">
            
                  <div class="card-body">
          <div class="row">
         
              
                <div class="col-4">
               
<div class="form-group">
<input type="text" name="code" value="" placeholder="Voucher Code" class="form-control">
                  </div>
<div class="form-group">
<input type="number" name="discount" value="" placeholder="Voucher Discount in %" class="form-control">
                  </div>
                  
                  <div class="form-group">
<input type="number" name="max_uses" value="" placeholder="Max Uses Allowed" class="form-control">
                  </div>
                  <div class="form-group">
<input type="number" name="max_uses_user" value="" placeholder="Max Uses Per User Allowed" class="form-control">
                  </div>
                  <div class="form-group">
                 <label>Active From</label>      
<input type="date" name="starts_at" class="form-control">
                  </div>
                  
                  <div class="form-group">
                       <label>Expires At</label>
<input type="date" name="expires_at" class="form-control">
                  </div>
                </div>
              
              <div class="col-4">
            
<div class="form-group">
    <label>Description</label>
    <textarea class="summernote" name="description"></textarea>
</div>

                


               
</div>



</div>


<div class="form-group">
<input type="submit" name="submit" value=" Create Voucher " class="btn btn-primary ">
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