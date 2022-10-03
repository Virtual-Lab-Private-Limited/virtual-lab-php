<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$tests=mysqli_query($con,"select * from tests where id='$id' limit 1") or die (mysqli_error());
while($data=mysqli_fetch_array($tests)){
	$title=$data['title'];
}

	if(!empty($_POST["submit"])) {	
		$itemCount = count($_POST["index_number"]);
		$itemValues=0;
	$query = "INSERT INTO frenchise_perameters (labid,tid,pid,units,referencevalues
) VALUES ";
		$queryValue = "";
		for($i=0;$i<$itemCount;$i++) {
			if(!empty($_POST["index_number"][$i])) {
				$itemValues++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('$session_labid','" . $_POST["tid"][$i] . "','" . $_POST["pid"][$i] . "','" . $_POST["unit"][$i] . "','" . $_POST["referencevalue"][$i] . "')";
			}
		}
		$sql = $query.$queryValue;
		if($itemValues!=0) {
			$result = mysqli_query($con,$sql) or die (mysqli_error($con));
			if(!empty($result))
		//	session_destroy();

echo '<script language="javascript">window.location = "'.$baseurl.'perameter_details/'.$id.'.html"</script>';
		
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
          <div class="row">
          
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<?php
$check_tests=mysqli_query($con,"select * from frenchise_perameters where labid='$session_labid'
and tid='$id'") or die (mysqli_error());
$count_test=mysqli_num_rows($check_tests);

if($count_test>0){
?>
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Perameter Title</th>
<th>Normal Value</th>
<th>Unit</th>
<th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$units=mysqli_query($con,"select * from test_perameters where tid='$id' order by id desc") or die (mysqli_error());
while($info=mysqli_fetch_array($units)){

?>
                          <tr>
<td><?php echo $info['title'];?></td>
<td><?php echo $info['value'];?></td>
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
<?php
}else{
?>
 <form action="<?php echo $baseurl;?>perameter_details/<?php echo $id;?>.html" method="post">

                      <table class="table table-striped table-hover" style="width:100%;">
                        <thead>
                          <tr>
<th>Perameter Title</th>
<th width="20%">Normal Value</th>
<th width="20%">Unit</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$a=1;
$units=mysqli_query($con,"select * from test_perameters where tid='$id' order by id desc") or die (mysqli_error());
while($info=mysqli_fetch_array($units)){

?>
                          <tr>
<td><?php echo $info['title'];?></td>
<td>
<input type="checkbox" name="index_number[]" value="<?php echo $a++;?>" checked class="hidden">
<input type="hidden" name="pid[]" value="<?php echo $info['id'];?>" class="form-control">
<input type="hidden" name="tid[]" value="<?php echo $id;?>" class="form-control">

<input type="text" class="form-control" name="referencevalue[]" value="<?php echo $info['value'];?>"></td>
<td><input type="text" class="form-control" name="unit[]" value="<?php echo $info['unit'];?>"></td>
                          </tr>

<?php
}
?>
                        </tbody>
                      </table>
<input type="submit" name="submit" value=" Add Perameters " class="btn  btn-primary">

</form>
<?php
}
?>
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