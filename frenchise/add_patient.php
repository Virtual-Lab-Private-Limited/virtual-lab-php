<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
if(isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $cnic=$_POST['cnic'];
    $contact=$_POST['contact'];
    $city=$_POST['city'];
    $address=$_POST['address'];
    $dob=$_POST['dob'];
    $blood_group=$_POST['blood_group'];
    $gender=$_POST['gender'];
    
    $dateOfBirth = $dob;
    $today = date("Y-m-d");
    $age = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $age->format('%y');
    
    $dir='../images';	
    $name=basename($_FILES['picture']['name']);
    $t_name=$_FILES['picture']['tmp_name'];
    
    if (empty($cnic)){
        $count_cnic = 0;
    }
    else {
        $cnic_query = mysqli_query($con,"select * from patients where cnic='$cnic' limit 1") or die (mysqli_error($con));
        $count_cnic = mysqli_num_rows($cnic_query);
    }
    
    if($count_cnic>0){
    	$message='<font color="red">CNIC is already issued to another Patient</font>';
    }else{
    
    if( ! empty($name)) {
      move_uploaded_file($t_name,$dir.'/'.$name);
    }

    mysqli_query($con,"insert into patients (firstname,lastname,cnic,contact,address,city,dob,age,blood_group,date_entry,gender,labid,addby,parentid, profile)
        values('$firstname','$lastname','$cnic','$contact','$address','$city','$dob','$age','$blood_group',now(),'$gender','$session_labid','$session_id','0', 'images/$name')") or die (mysqli_error($con));
	$id = mysqli_insert_id($con);
    $patient_no = date("Y") .'-'. date("dm").'-'. $id;
    mysqli_query($con,"update patients set patient_no = '$patient_no' where id ='$id' ") or die (mysqli_error($con));
	$message='<font color="green">Patient has been added successfully</font>';
	
}


}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Patient | <?php echo $basetitle;?></title>
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
<style>
    .red { color: red;} 
</style>
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
<h1>Add New Patient</h1> 	&nbsp;	&nbsp;	&nbsp; <a href="<?php echo $baseurl;?>patient_list.html" class="btn btn-success">List of Patients</a>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="add_patient.html" method="post" enctype="multipart/form-data"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Personal Information</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
<label>First Name <span class="red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="firstname" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Last Name <span class="red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="lastname" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>CNIC</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-address-card"></i>
</div>
                        </div>
<input type="text" class="form-control" name="cnic" value="">
                      </div>
                    </div>
                    <div class="form-group">
<label>Contact <span class="red">*</span></label>
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
                    <label>Profile image</label>
                    <div class="input-group">
                        <input type="file" class="form-control" name="picture" >
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
<textarea class="form-control" name="address"></textarea>
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
    <label>Select Gender <span class="red">*</span></label>
<div class="input-group">
<select name="gender" class="form-control">
<option>Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
                      </div>
                    </div>
                    <div class="form-group">
                <label>DOB <span class="red">*</span></label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-calendar"></i>
</div>
                        </div>
<input type="date" class="form-control" name="dob" value="" placeholder="DOB">
                      </div>
                    </div>

                    
                    <div class="form-group">
<label>Blood Group</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-briefcase-medical"></i>
</div>
                        </div>
<input type="text" class="form-control" name="blood_group" value="">
                      </div>
                    </div>
                   
                    <div class="form-group">
<input type="submit" name="submit" value=" Add Patient " class="btn btn-block btn-info">                    </div>
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