<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];

$references=mysqli_query($con,"select * from test_reference where id='$id' limit 1") or die (mysqli_error());
while($rs=mysqli_fetch_array($references)){

	$tid=$rs['testid'];
}
$tests=mysqli_query($con,"select * from tests where id='$tid' limit 1") or die (mysqli_error());
while($ts=mysqli_fetch_array($tests)){
	$title=$ts['title'];
}

if(isset($_POST['submit'])){
	$tid=$_POST['tid'];
	$reference_value=$_POST['dropdown_value'];

$test_references=mysqli_query($con,"select * from test_dropdowns where refid='$tid' and value='$reference_value' limit 1") or die (mysqli_error($con));
$count_reference=mysqli_num_rows($test_references);
if($count_reference>0){
	$message='<font color="Green">
<p align="center">Sorry Sir/Madam<br>
 The following Dropdown Value Already Exist.	
	</p>
	</font>';
	
	
}else{
	
	mysqli_query($con,"insert into test_dropdowns(refid,value)values('$tid','$reference_value')") or die (mysqli_error($con));
	$message='<font color="Green">
<p align="center"> Sir/Madam<br>
 The following Dropdown Value has been added.	
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
  <title>Add Drop Down Value | <?php echo $basetitle;?></title>
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
									<h1><?php echo $title;?> Test Dropdown List</h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="<?php echo $baseurl;?>reference/<?php echo $tid;?>.html" class="btn btn-warning">Back</a>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
 <form action="<?php echo $baseurl;?>add_dropdown/<?php echo $id;?>.html" method="post">             
                      <div class="row">
              <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label> <?php echo $title;?></label>
                       <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><i class="
fas fa-clipboard-list"></i></strong>
                          </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Dropdown Value" name="dropdown_value" value="" required autocomplete="off">
                        <input type="hidden" class="form-control"  name="tid" value="<?php echo $id;?>" required>

                      </div>
                                        <div class="form-group">
<input type="submit" name="submit" value=" Add Value " class="btn btn-block btn-info">                    </div>

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
<th>Value</th>  <th>Delete</th>                        
                          </tr>
                        </thead>
                        <tbody>
<?php
$references=mysqli_query($con,"select * from test_dropdowns where refid='$id' order by id desc") or die (mysqli_error());
while($info=mysqli_fetch_array($references)){

?>
                          <tr>

<td><?php echo $info['value'];?></td>
<td width="2%">
<a href="<?php echo $baseurl;?>delete_dropdown.php?id=<?php echo $info['id'];?>&tid=<?php echo $id;?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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