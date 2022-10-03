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
$id=$_GET['id'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
$testid=mysqli_real_escape_string($con,$_POST['testid']);
$packageid=mysqli_real_escape_string($con,$_POST['packageid']);

$query_tests=mysqli_query($con,"select * from package_details where packageid='$packageid' and testid='$testid' limit 1") or die (mysqli_error());

$count_test=mysqli_num_rows($query_tests);
if($count_test>0){
$message='<font color="red"><p align="center">The Following Test is already Exist in the Test</p></font>';	
}else{

mysqli_query($con,"insert into package_details(packageid,testid) values ('$packageid','$testid')") or die (mysqli_error($con));

$message='<font color="green"><p align="center">Your Test has been Added	 successfully</p>
</font>
'; 

}
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Test Package | <?php echo $basetitle;?></title>
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
<form action="<?php echo $baseurl;?>pack/<?php echo $id;?>.html" method="post">
          <div class="row">
          
              <div class="col-4">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
<div class="form-group">
<label>Select Test</label>
<select name="testid" class="form-control" required>
<?php
$tests=mysqli_query($con,"select * from tests") or die (mysqli_error());
while($info=mysqli_fetch_array($tests)){
?>
<option value="<?php echo $info['id'];?>"><?php echo $info['title'];?></option>
<?php
}
?>
</select>
<input type="hidden" name="packageid" value="<?php echo $id;?>" >

                  </div>

<div class="form-group">
<input type="submit" name="submit" value=" Add Test to Package " class="btn btn-primary btn-block">


                  </div>
<?php echo $message;?>
                </div>
              </div>
</div>

            </div>
            
</form>
          </div>
        </section>

        <section class="section">
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
<th width="5%"> Sr#. </th>
<th>Test</th>
<th>Price</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$package_details=mysqli_query($con,"select * from package_details where packageid='$id' order by id") or die (mysqli_error($con));
while($info=mysqli_fetch_array($package_details)){
?>
                          <tr>
<td><?php echo $info['id'];?></td>
<td><?php 
$tests=mysqli_query($con,"select * from tests where id='".$info['testid']."' order by id limit 1") or die (mysqli_error($con));
while($row=mysqli_fetch_array($tests)){

echo $row['title'];
$price = $row['price'];
}
?>

</td>
<td><?php echo $price; ?></td>
<td width="15%">
<a href="<?php echo $baseurl;?>remove_test.php?id=<?php echo $info['id'];?>&pid=<?php echo $id;?>" class="btn btn-danger">Remove</a>

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