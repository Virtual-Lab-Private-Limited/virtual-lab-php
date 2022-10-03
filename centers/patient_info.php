<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];
$patients=mysqli_query($con,"select * from patients where id='$id' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($patients)){
	$firstname=$info['firstname'];
    $lastname=$info['lastname'];
    $cnic=$info['cnic'];
    $contact=$info['contact'];
    $city=$info['city'];
    $dob=$info['dob'];
    $age=$info['age'];
    $blood_group=$info['blood_group'];
    $address=$info['address'];
    $picture=$info['profile'];
     $gender=$info['gender'];

}

if(isset($_POST['submit'])){
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$ncnic=$_POST['cnic'];
$phone=$_POST['contact'];
$ncity=$_POST['city'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$bloodgroup=$_POST['blood_group'];
$password=md5($_POST['password']);
$pass=$_POST['password'];
$address=$_POST['address'];
$uid=$_POST['uid'];
$dir='../images';	
$name=basename($_FILES['picture']['name']);
$t_name=$_FILES['picture']['tmp_name'];

$dateOfBirth = $dob;
$today = date("Y-m-d");
$age = date_diff(date_create($dateOfBirth), date_create($today));
$age = $age->format('%y');


if( ! empty($name)) {
   
  move_uploaded_file($t_name,$dir.'/'.$name);
  mysqli_query($con,"update patients set firstname='$fname',lastname='$lname',cnic='$ncnic',contact='$phone',address='$address', city='$ncity',dob='$dob',age='$age', gender='$gender',blood_group='$bloodgroup',profile='images/$name'  where id='$uid' limit 1") or die (mysqli_error($con));
	$message='<font color="green">Patient has been added successfully</font>';

} else {
    mysqli_query($con,"update patients set firstname='$fname',lastname='$lname',cnic='$ncnic',contact='$phone',address='$address', city='$ncity',dob='$dob',age='$age', gender='$gender',blood_group='$bloodgroup' where id='$uid' limit 1") or die (mysqli_error($con));
	$message='<font color="green">Patient has been added successfully</font>';

}



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
<h1><?php echo $firstname.' '.$lastname;?>'s Info</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="<?php echo $baseurl;?>patient_info/<?php echo $id;?>.html" method="post" enctype="multipart/form-data"> 
            <div class="row">
              
           <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
<h4>Personal Information</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
<label>First Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="hidden" class="form-control" name="uid" value="<?php echo $id;?>">
<input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
<input type="text" class="form-control" name="lastname" value="<?php echo $lastname;?>">
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
         <label>Profile </label>
                      <div class="input-group">
                    
            <img src="https://virtuallab.com.pk/<? echo $picture;?>" width="250" height="200">
            
            
           <div><input type="file" class="form-control" name="picture" ></div>

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
<textarea class="form-control" name="address"><?php echo $address;?></textarea>
</div>
                  <div class="form-group">
<label>City</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-globe"></i>
</div>
                        </div>
<input type="text" class="form-control" name="city" value="<?php echo $city;?>">
                      </div>
                    </div>
                    <div class="form-group">
<label>DOB</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-calendar"></i>
</div>
                        </div>
<input type="date" class="form-control" name="dob" value="<?php echo $dob;?>">
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
<input type="text" class="form-control" name="blood_group" value="<?php echo $blood_group;?>">
                      </div>
                    </div>
              <div class="form-group">
<label>Gender</label>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-male"></i>
</div>
                        </div>
<select class="form-control" name="gender" >
       <option value="<?php echo $gender;?>"><?php echo $gender;?></option>
       <br>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    </select>
                      </div>
                    </div>
                    <div class="form-group">
<input type="submit" name="submit" value=" Update Info " class="btn btn-block btn-info">                    </div>
                   </div>
                  </div>
                
              </div>


            </div>
</form>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Booking #</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Test Title</th>
<th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$bookings=mysqli_query($con,"select * from booking_details where status='complete' and pid='$id' order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($bookings)){

$books=mysqli_query($con,"select *  from bookings where id='".$info['bid']."'  limit 1") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){
	$bookingno=$book['bookingno'];	
}
?>
                          <tr>
<td><?php echo $bookingno;?></td>
<td><?php echo $cnic;?></td>
<td><?php echo $contact;?></td>
<td><?php
$tests=mysqli_query($con,"select *  from tests where id='".$info['tid']."'  limit 1") or die (mysqli_error());
while($test=mysqli_fetch_array($tests)){
echo	$test['title'];
	
}
?></td>

<td width="5%">
<a href="<?php echo $baseurl;?>report/<?php echo $info['id'];?>.html" class="btn btn-info"><i class="fa fa-print"></i></a>
                            </td>
                          </tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
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