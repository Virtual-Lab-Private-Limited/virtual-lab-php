<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$tests=mysqli_query($con,"select * from test_perameters where id='$id' limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($tests)){
	$title=$data['title'];
	$gender=$data['gender'];
	$value=$data['value'];
	$unit=$data['unit'];
	$tid=$data['tid'];
	$remarks=$data['remarks'];
}
if(isset($_POST['submit'])){
	$ntitle=$_POST['title'];
	$ngender=$_POST['gender'];
	$nvalue=$_POST['normal_value'];
	$nunit=$_POST['unit'];	
	$tid=$_POST['tid'];
	$testid=$_POST['testid'];
$remark=mysqli_real_escape_string($con,$_POST['remarks']);

mysqli_query($con,"update test_perameters set title='$ntitle',gender='$ngender',value='$nvalue',unit='$nunit',remarks='$remark' where tid='$tid' limit 1") or die (mysqli_error());
header("location:".$baseurl."perameter_details/".$testid.".html");
	
}
?><!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Perameter Details | <?php echo $basetitle;?></title>
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
              <div class="col-12 col-md-4 col-lg-4">
   <form method="post" action="<?php echo $baseurl;?>perameters/<?php echo $id;?>">             <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label> Title</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-font"></i></strong>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Perameter Title" name="title" value="<?php echo $title;?>" required>
                        <input type="hidden" class="form-control" placeholder="Perameter Title" name="tid" value="<?php echo $id;?>" required>
                        <input type="hidden" class="form-control" placeholder="Perameter Title" name="testid" value="<?php echo $tid;?>" required>

                      </div>
                       <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-clipboard-list"></i></strong>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Normal Value" name="normal_value" value="<?php echo $value;?>" required>
                      </div>
                       <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="fas fa-transgender"></i></strong>
                          </div>
                        </div>
<select class="form-control select2" name="gender">
<option value="">Select Gender</option>
<option value="<?php echo $gender;?>" selected><?php echo $gender;?></option>
<option value="Male">Male</option>
<option value="Female">Female</option>

                      </select>
                      </div>
                       <div class="input-group">
                        <div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-weight-hanging"></i>
                          </div>
                        </div>
<input type="text" class="form-control" placeholder="Measurment Unit" value="<?php echo $unit;?>" name="unit">
                      </div>
                                        <div class="form-group">
<input type="submit" name="submit" class="btn btn-block btn-info" value=" Update Perameter ">                    </div>

                    </div>
 	
                    
                  </div>
                </div>
</form>
              </div>
              <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label>Test Remarks</label>
<textarea class="summernote" name="remarks">
<?php echo $remarks;?>
</textarea>

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