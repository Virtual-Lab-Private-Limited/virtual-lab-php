<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0 || $session_role == 'user' ){
	header("location:".$baseurl."login.html");
	exit();
}
	if(!empty($_POST["submit"])) {	
		$itemCount = count($_POST["index_number"]);
		$itemValues=0;
	$query = "INSERT INTO frenchise_details (frenchiseid,testid,rate) VALUES ";
		$queryValue = "";
		for($i=0;$i<$itemCount;$i++) {
			if(!empty($_POST["index_number"][$i])) {
				$itemValues++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('$session_labid','" . $_POST["tid"][$i] . "','" . $_POST["rate"][$i] . "')";
			}
		}
		$sql = $query.$queryValue;
		if($itemValues!=0) {
			$result = mysqli_query($con,$sql) or die (mysqli_error($con));
			if(!empty($result))
		//	session_destroy();

echo '<script language="javascript">window.location = "'.$baseurl.'test_settings.html"</script>';
		
		}
	}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Test List | <?php echo $basetitle;?></title>
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
          <div class="row">
          
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

<?php

$check_tests=mysqli_query($con,"select * from frenchise_details where frenchiseid='$session_labid'
") or die (mysqli_error());
$count_test=mysqli_num_rows($check_tests);

if($count_test>0){
?>
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th width="5%"> Test ID</th>
<th>Test Title</th>
<th width="10%">Rate</th>
<th width="10%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$b=1;
$frenchise_tests=mysqli_query($con,"select * from frenchise_details where frenchiseid='$session_labid' order by id") or die (mysqli_error($con));
while($info=mysqli_fetch_array($frenchise_tests)){

?>
                          <tr>
<td><?php echo $b++;?></td>
<td><?php $tests=mysqli_query($con,"select * from tests where id='".$info['testid']."' order by id") or die (mysqli_error($con));
while($row=mysqli_fetch_array($tests)){
echo $row['title'];
$tid=$row['id'];
}
?></td>
<td><a href="<?php echo $baseurl;?>change_rate/<?php echo $tid;?>" class="btn btn-success"><i class="fa fa-edit"></i><?php echo $info['rate'];?></a></td>

<td>
<a href="<?php echo $baseurl;?>perameter_details/<?php echo $tid;?>.html" class="btn btn-info">Perameter</a>
                            </td>
                          </tr>
<?php
}?>
  </tbody>
                      </table>
<?php
}else{
?>
 <form action="<?php echo $baseurl;?>test_settings.html" method="post">
                      <table class="table table-striped table-hover" style="width:100%;">
                        <thead>
                          <tr>
<th width="5%"> Test ID</th>
<th>Test Title</th>

<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$a=1;
$tests=mysqli_query($con,"select * from tests order by id") or die (mysqli_error($con));
while($info=mysqli_fetch_array($tests)){
?>
                          <tr>
<td>
<?php echo $info['id'];?>
<input type="checkbox" name="index_number[]" value="<?php echo $a++;?>" checked class="hidden">
<input type="hidden" name="tid[]" value="<?php echo $info['id'];?>" class="form-control">

</td>
<td><?php echo $info['title'];?></td>
<td width="25%">
<input type="text" name="rate[]" value="<?php echo $info['price'];?>" class="form-control" placeholder="Rate">

                            </td>
                          </tr>
<?php
}?>
  </tbody>
                      </table>
<input type="submit" name="submit" value=" Add Test " class="btn  btn-primary">

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