<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}function string_limit_words($string, $word_limit) {
   $words = explode(' ', $string);
   return implode(' ', array_slice($words, 0, $word_limit));
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
$firstname=mysqli_real_escape_string($con,$_POST['firstname']);
$lastname=mysqli_real_escape_string($con,$_POST['lastname']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$contact=mysqli_real_escape_string($con,$_POST['contact']);
$city=mysqli_real_escape_string($con,$_POST['city']);
$clinic=mysqli_real_escape_string($con,$_POST['clinic']);
$address=mysqli_real_escape_string($con,$_POST['address']);
$gender=mysqli_real_escape_string($con,$_POST['gender']);
$education=mysqli_real_escape_string($con,$_POST['education']);
$share=mysqli_real_escape_string($con,$_POST['share']);


$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;


mysqli_query($con,"insert into doctors(firstname,lastname,email,phone,city,clinic,gender,address,education,labid,share) values 
('$firstname','$lastname','$email','$contact','$city','$clinic','$gender','$address','$education','$session_labid', '$share')") or die (mysqli_error($con));

$message='<font color="green"><p align="center">Doctor has been added successfully</p>
</font>
'; 
header("location:".$baseurl."doctors.php");

}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Doctor | <?php echo $basetitle;?></title>
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
            
            <div class="row">
              <div class="col-12">
           <div class="section-body">
<form method="post" action="<?php echo $baseurl;?>add_doctor.html">
        <div class="row">
              
           <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-header">
<h4>Personal Information</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="firstname" placeholder="First Name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="lastname" placeholder="Last Name" value="">
                      </div>
                    </div>
                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
                        </div>
<input type="text" placeholder="Email" class="form-control" name="email" value="">
                      </div>
                    </div>
                                    <div class="form-group">
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
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i>
</div>
                        </div>
<input type="text" class="form-control" name="contact" placeholder="Contact Number" value="">
                      </div>
                    </div>
                    <div class="form-group">
<input type="text" class="form-control" placeholder="Clinic / Hospital" name="clinic" value="">
</div>
                    <div class="form-group">
<input type="text" class="form-control" placeholder="Clinic / Hospital Address" name="address" value="">
</div>
     <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-percentage"></i>
                          </div>
                        </div>
<input type="number" class="form-control" name="share" placeholder="Share" value="">
                      </div>
                    </div>
                    <div class="form-group">
<input type="submit" class="btn btn-info btn-block" name="submit" value=" Add Doctor ">
</div>

                  </div>
                </div>
              </div>
              <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label>Doctor's Education</label>
<textarea class="summernote" name="education"></textarea>

                    </div>
                    
                  </div>

                </div>
              </div>
            </div>
</form>
            
            
          </div>
              </div>
            </div>
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