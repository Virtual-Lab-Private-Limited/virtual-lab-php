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
if($_SERVER["REQUEST_METHOD"] == "POST"){
$title=mysqli_real_escape_string($con,$_POST['title']);
$price=mysqli_real_escape_string($con,$_POST['price']);
$cost=mysqli_real_escape_string($con,$_POST['cost']);
$remakrs=mysqli_real_escape_string($con,$_POST['remarks']);
$test_type=mysqli_real_escape_string($con,$_POST['test_type']);
$sample=mysqli_real_escape_string($con,$_POST['sample']);

$catid=$_POST['catid'];
$organid=$_POST['organid'];
$disid=$_POST['disid'];

$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;

$query_tests=mysqli_query($con,"select * from tests where title='$title' limit 1") or die (mysqli_error());

$count_test=mysqli_num_rows($query_tests);
if($count_test>0){
$message='<font color="red"><p align="center">The Following Test is already Exist</p></font>';	
}else{

mysqli_query($con,"insert into tests(title,slug,price,cost,remarks,type,catid,organid,disid,sample) values ('$title','$url','$price','$cost','$remakrs','$test_type','$catid','$organid','$disid','$sample')") or die (mysqli_error($con));
$pid=mysqli_insert_id($con);

$message='<font color="green"><p align="center">Your Test has been added successfully</p>
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
  <title>Packages | <?php echo $basetitle;?></title>
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
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th width="5%"> Sr#. </th>
<th>Package</th>
<th>Price</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$packages=mysqli_query($con,"select * from packages order by id") or die (mysqli_error($con));
while($info=mysqli_fetch_array($packages)){
?>
                          <tr>
<td><?php echo $info['id'];?></td>
<td><?php echo $info['title'];?></td>
<td><?php echo $info['price'];?></td>
<td width="20%">
    <div class="row">
        <div class="col-md-6"><a href="<?php echo $baseurl;?>pack/<?php echo $info['id'];?>.html" class="btn btn-info">Add Test</a>
</div>
        <div class="col-md-4"><a href="<?php echo $baseurl.'edit_package.php?id='.$info['id'];?>" class="btn btn-success">Edit</a>
</div>
    </div>

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