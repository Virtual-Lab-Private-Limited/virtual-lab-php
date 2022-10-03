<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$message='';

if(isset($_POST['submit'])){
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$cnic=$_POST['cnic'];
$contact=$_POST['contact'];
$city=$_POST['city'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$blood_group=$_POST['blood_group'];
$gender=$_POST['gender'];

$dateOfBirth = $dob;
$today = date("Y-m-d");
$age = date_diff(date_create($dateOfBirth), date_create($today));
$age = $age->format('%y');
  
if ($cnic != ''){
    $cnic_query=mysqli_query($con,"select * from patients where cnic='$cnic' limit 1") or die (mysqli_error($con));
    $count_cnic=mysqli_num_rows($cnic_query);
} else {
    $count_cnic = 0;
}


if($count_cnic>0){
	$message='<font color="red">CNIC is already issued to another Patient</font>';
}else{
mysqli_query($con,"insert into patients (firstname,lastname,cnic,contact,address,city,dob,age,blood_group,date_entry,gender,labid,addby,parentid, cc_no)
values('$firstname','$lastname','$cnic','$contact','$address','$city','$dob','$age','$blood_group',now(),'$gender','$session_labid','$session_id','0', '$session_id')") or die (mysqli_error($con));
	
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
  <title><?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>
<style>
    .red {
        color: red;
    }
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
<h1>Add New Patient</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
<form action="index.php" method="post"> 
            <div class="row">
              
           <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<i class="fas fa-user"></i><span class='red'>*</span>
                          </div>
                        </div>
<input type="text" class="form-control" name="firstname" value="" placeholder=" First Name " required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i><span class='red'>*</span>
                          </div>
                        </div>
<input type="text" class="form-control" name="lastname" value="" placeholder=" Last Name " required>
                      </div>
                    </div>
                  <div class="form-group">
        <div class="input-group">             
        <div class="input-group-prepend">
          <div class="input-group-text">
            Gender <span class='red'>*</span>
          </div>
        </div>
        <select name="gender" class="form-control">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        </select>
                      </div>
                    </div>
                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-address-card"></i>
</div>
                        </div>
<input type="text" class="form-control" name="cnic" value="" placeholder=" CNIC ">
                      </div>
                    </div>
                    
                   
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4 col-lg-4">
              	<div class="card">
                  <div class="card-body">
                             <div class="form-group">
<label>Address <span class='red'>*</span></label>
<textarea class="form-control" name="address"></textarea>
</div>
                                       <div class="form-group">
<select class="form-control select2" name="city" required>
<option>Select City</option>
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
<i class="fas fa-calendar"></i><span class='red'>*</span>
</div>
                        </div>
<input type="date" class="form-control" name="dob" value="" placeholder="Date of Birth">
                      </div>
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
<i class="fas fa-briefcase-medical"></i>
</div>
                        </div>
<input type="text" class="form-control" name="blood_group" value="" placeholder=" Blood Group ">
                      </div>
                    </div>
                    <div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-phone"></i><span class='red'>*</span>
</div>
                        </div>
<input type="text" class="form-control" name="contact" value="" placeholder=" Phone Number" required>
                      </div>
                    </div>
                    <div class="form-group">
<input type="submit" name="submit" value=" Add Patient " class="btn btn-block btn-info">                
</div>
  <?php echo $message;?>
                   </div>
                  </div>
              
              </div>

            </div>
</form>
          </div>

          <div class="section-body">
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
<th>Patient #</th>
<th>Patient Name</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$staff_members=mysqli_query($con,"select * from patients where cc_no='$session_id' order by date_entry asc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($staff_members)){

?>
                          <tr>
<td><?php echo $info['patient_no'];?></td>                              
<td><?php echo $info['firstname'].' '.$info['lastname'];?></td>
<td><?php echo $info['cnic'];?></td>
<td><?php echo $info['contact'];?></td>
<td width="14%">
<a href="<?php echo $baseurl;?>patient_info/<?php echo $info['id'];?>.html" class="btn btn-info"><i class="fa fa-edit"></i> Info </a>
<a href="<?php echo $baseurl;?>add_test/<?php echo $info['id'];?>.html" class="btn btn-success"><i class="fa fa-plus"></i> Test </a>
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

<?php

include("includes/footer.php");
?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  
</body>


</html>