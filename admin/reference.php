<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];

$tests=mysqli_query($con,"select * from tests where id='$id' limit 1") or die (mysqli_error());
while($ts=mysqli_fetch_array($tests)){
	$title=$ts['title'];
}

if(isset($_POST['submit'])){
	$tid=$_POST['tid'];
	$additional_data=$_POST['additional_data'];
	$minimum_value=$_POST['minimum_value'];
	$gender=$_POST['gender'];
	$maximum_value=$_POST['maximum_value'];

$test_references=mysqli_query($con,"select * from test_reference where testid='$tid' and gender='$gender' limit 1") or die (mysqli_error());
$count_reference=mysqli_num_rows($test_references);
if($count_reference>0){
	$message='<font color="Green">
<p align="center">Sorry Sir/Madam<br>
 The following Reference Value Already Exist.	
	</p>
	</font>';
	
	
}else{
	
	mysqli_query($con,"insert into test_reference(testid,gender,maximum_value,minimum_value,additional_data)values('$tid','$gender','$maximum_value','$minimum_value','$additional_data')") or die (mysqli_error($con));
	$message='<font color="Green">
<p align="center"> Sir/Madam<br>
 The following Reference Value has been added.	
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
  <title>Reference | <?php echo $basetitle;?></title>
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
<h1><?php echo $title;?> Test Reference List</h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="<?php echo $baseurl;?>addtest.html" class="btn btn-warning">Back to tests</a>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
 <form action="<?php echo $baseurl;?>reference/<?php echo $id;?>.html" method="post">             
                      <div class="row">
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label> <?php echo $title;?></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-font"></i></strong>
                          </div>
                        </div>
<select class="form-control select2" name="gender" >
<option value="">Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>


                      </select>
                        <input type="hidden" class="form-control" placeholder="Perameter Title" name="tid" value="<?php echo $id;?>" required>

                      </div>

              
                       <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-clipboard-list"></i></strong>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Minimum Value" name="minimum_value" value="">
                      </div>

                       <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-clipboard-list"></i></strong>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Maximum Value" name="maximum_value" value="" >
                      </div>
                    
                      <div class="form-group">
                        <label>Additional data:</label>
                        <textarea class="form-control" rows="10" placeholder="Additional Data" name="additional_data"></textarea>
                      </div>
                    
 	
                    <div class="form-group">
  <input type="submit" name="submit" class="btn btn-block btn-info">                    </div>
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
                      <table class="table table-striped table-hover" id="save-stage">
                        <thead>
                          <tr>
                          <th>Gender</th>                          
                          <th>Minimum Value</th>
                          <th>Maximum Value</th>
                          <th>Reference Value</th>
                          <th style="width:200px">Additional Data</th>
                          <th colspan=2>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$references=mysqli_query($con,"select * from test_reference where testid='$id' order by id desc") or die (mysqli_error());
while($info=mysqli_fetch_array($references)){

?>
<tr>
    <td><?php echo $info['gender'];?></td>
    <td><?php echo $info['minimum_value'];?></td>
    <td><?php echo $info['maximum_value'];?></td>
    <td><?php echo $info['minimum_value']?> - <?php echo $info['maximum_value']?></td>
    <td><?php echo $info['additional_data'];?></td>
    <td width="5%">
    <a href="<?php echo $baseurl;?>add_dropdown/<?php echo $info['id'];?>.html" class="btn btn-info">Dropdown</a></td>
    <td width="5%">
    <a href="<?php echo $baseurl;?>delete_reference.php?id=<?php echo $info['id'];?>&tid=<?php echo $id;?>" class="btn btn-danger">X</a>
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