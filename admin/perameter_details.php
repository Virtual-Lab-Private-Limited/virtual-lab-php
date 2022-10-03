<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$heads=mysqli_query($con,"select * from test_heads where id='$id' limit 1") or die (mysqli_error($con));
while($data=mysqli_fetch_array($heads)){
	$head_title=$data['title'];
	$testid=$data['tid'];
}
$tests=mysqli_query($con,"select * from tests where id='$testid' limit 1") or die (mysqli_error());
while($ts=mysqli_fetch_array($tests)){
	$title=$ts['title'];
}

if(isset($_POST['submit'])){
	$tid=$_POST['tid'];
	$hid=$_POST['hid'];
	$ptitle=$_POST['title'];
	$pvalue=$_POST['normal_value'];
	$gender=$_POST['gender'];
	$unit=$_POST['unit'];
	$remakrs=mysqli_real_escape_string($con,$_POST['remarks']);
	

$peras=mysqli_query($con,"select * from test_perameters where title='$ptitle' and tid='$tid' and gender='$gender' limit 1") or die (mysqli_error());
	
$count_pera=mysqli_num_rows($peras);
if($count_pera>0){
$message='<font color="red">
<p align="center">Sorry Sir/Madam<br>
 The following perameter is already exist in our database, kindly double check perameters details.	
	</p>
	</font>';
	
}else{
	mysqli_query($con,"insert into test_perameters(tid,title,value,gender,unit,remarks,headid)values('$tid','$ptitle','$pvalue','$gender','$unit','$remakrs','$hid')") or die (mysqli_error($con));
	$message='<font color="Green">
<p align="center">Sorry Sir/Madam<br>
 The following perameter has been added to the following test.	
	</p>
	</font>';
}

}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Perameter | <?php echo $basetitle;?></title>
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
									<h1><?php echo $title;?> Test Perameters List</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
 <form action="<?php echo $baseurl;?>perameter_details/<?php echo $id;?>.html" method="post">             
                      <div class="row">
              <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label> <?php echo $head_title;?></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-font"></i></strong>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Perameter Title" name="title" value="" required>
                        <input type="hidden" class="form-control" placeholder="Perameter Title" name="tid" value="<?php echo $testid;?>" required>
                        <input type="hidden" class="form-control" placeholder="Perameter Title" name="hid" value="<?php echo $id;?>" required>

                      </div>
                       <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-clipboard-list"></i></strong>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Normal Value" name="normal_value" value="" required>
                      </div>
                       <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="fas fa-transgender"></i></strong>
                          </div>
                        </div>
<select class="form-control select2" name="gender">
<option value="">Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Both">Both Male & Female</option>

                      </select>
                      </div>
                       <div class="input-group">
                        <div class="input-group-prepend">
<div class="input-group-text">
<i class="fas fa-weight-hanging"></i>
                          </div>
                        </div>
<input type="text" class="form-control" placeholder="Measurment Unit" name="unit">
                      </div>
                                        <div class="form-group">
<input type="submit" name="submit" class="btn btn-block btn-info">                    </div>

                    </div>
 	
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label>Test Remarks</label>
<textarea class="summernote" name="remarks"></textarea>

                    </div>
                    
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
<th>Perameter Title</th>
<th>Normal Value</th>
<th>Gender</th>
<th>Unit</th>
<th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$units=mysqli_query($con,"select * from test_perameters where tid='$testid' and headid='$id' order by id desc") or die (mysqli_error());
while($info=mysqli_fetch_array($units)){

?>
                          <tr>
<td><?php echo $info['title'];?></td>
<td><?php echo $info['value'];?></td>
<td><?php echo $info['gender'];?></td>
<td><?php echo $info['unit'];?></td>
<td width="25%">
<a href="<?php echo $baseurl;?>perameters/<?php echo $info['id'];?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
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